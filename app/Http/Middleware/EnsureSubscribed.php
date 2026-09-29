<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureSubscribed
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        // Si está suscrito, todo bien
        if ($user->subscribed('default')) {
            return $next($request);
        }

        // Si aún tiene ejercicios gratis, permitir
        if ($user->free_exercises_used < User::FREE_EXERCISES_LIMIT) {
            return $next($request);
        }

        // Sin suscripción y sin ejercicios gratis
        return response()->json([
            'message' => 'Has usado tus 3 ejercicios gratis. Activa PequeMundo Premium para seguir jugando.',
            'subscribed' => false,
            'free_exercises_used' => $user->free_exercises_used,
            'free_exercises_limit' => User::FREE_EXERCISES_LIMIT,
        ], 403);
    }
}