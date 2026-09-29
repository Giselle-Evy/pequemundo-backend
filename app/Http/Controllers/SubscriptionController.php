<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Devuelve el estado de suscripción del usuario autenticado.
     */
    public function status(Request $request)
    {
        $user = $request->user();
        $subscription = $user->subscription('default');

        return response()->json([
            'subscribed' => $user->subscribed('default'),
            'on_trial' => $subscription ? $subscription->onTrial() : false,
            'on_grace_period' => $subscription ? $subscription->onGracePeriod() : false,
            'ends_at' => $subscription ? $subscription->ends_at : null,
        ]);
    }

    /**
     * Crea una sesión de Checkout de Stripe para suscribirse.
     */
    public function checkout(Request $request)
    {
        $user = $request->user();

        if ($user->subscribed('default')) {
            return response()->json([
                'message' => 'Ya tienes una suscripción activa.',
            ], 400);
        }

        $priceId = config('services.stripe.price_id');

        $checkout = $user->newSubscription('default', $priceId)
            ->checkout([
                'success_url' => env('FRONTEND_URL', 'http://localhost:5173') . '/dashboard?checkout=success',
                'cancel_url' => env('FRONTEND_URL', 'http://localhost:5173') . '/subscribe?checkout=cancel',
            ]);

        return response()->json([
            'url' => $checkout->url,
        ]);
    }

    /**
     * Devuelve la URL del portal de facturación de Stripe.
     */
    public function portal(Request $request)
    {
        $user = $request->user();

        // Si el usuario no tiene stripe_id, no puede acceder al portal
        if (! $user->stripe_id) {
            return response()->json([
                'message' => 'Aún no tienes una suscripción registrada.',
            ], 400);
        }

        try {
            $url = $user->billingPortalUrl(
                env('FRONTEND_URL', 'http://localhost:5173') . '/dashboard'
            );

            return response()->json(['url' => $url]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No pudimos abrir el portal: ' . $e->getMessage(),
            ], 500);
        }
    }
}