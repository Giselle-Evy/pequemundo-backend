<?php

namespace App\Http\Controllers;

use App\Models\ChildItem;
use App\Models\ChildProfile;
use App\Models\StoreItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Lista todos los items activos de la tienda + si el niño ya los tiene.
     */
    public function index(Request $request)
    {
        $request->validate([
            'child_profile_id' => 'required|exists:child_profiles,id',
        ]);

        $user = $request->user();
        $child = ChildProfile::findOrFail($request->child_profile_id);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $ownedIds = ChildItem::where('child_profile_id', $child->id)
            ->pluck('store_item_id')
            ->toArray();

        $items = StoreItem::where('is_active', true)
            ->orderBy('category')
            ->orderBy('price')
            ->get()
            ->map(function ($item) use ($ownedIds) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'category' => $item->category,
                    'icon' => $item->icon,
                    'price' => $item->price,
                    'owned' => in_array($item->id, $ownedIds),
                ];
            });

        return response()->json([
            'child' => $child,
            'total_points' => $child->total_points,
            'items' => $items,
        ]);
    }

    /**
     * Compra un item. Resta puntos si el niño tiene suficientes.
     */
    public function buy(Request $request)
    {
        $request->validate([
            'child_profile_id' => 'required|exists:child_profiles,id',
            'store_item_id' => 'required|exists:store_items,id',
        ]);

        $user = $request->user();
        $child = ChildProfile::findOrFail($request->child_profile_id);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $item = StoreItem::findOrFail($request->store_item_id);

        // Verificar si ya lo tiene
        $alreadyOwned = ChildItem::where('child_profile_id', $child->id)
            ->where('store_item_id', $item->id)
            ->exists();

        if ($alreadyOwned) {
            return response()->json(['message' => 'Ya tienes este item'], 400);
        }

        // Verificar puntos suficientes
        if ($child->total_points < $item->price) {
            return response()->json([
                'message' => 'No tienes suficientes puntos',
            ], 400);
        }

        DB::transaction(function () use ($child, $item) {
            $child->total_points -= $item->price;
            $child->save();

            ChildItem::create([
                'child_profile_id' => $child->id,
                'store_item_id' => $item->id,
                'purchased_at' => now(),
            ]);
        });

        return response()->json([
            'message' => '¡Compra exitosa!',
            'total_points' => $child->fresh()->total_points,
            'item' => $item,
        ]);
    }

    /**
     * Equipa un item ya comprado.
     */
    public function equip(Request $request)
    {
        $request->validate([
            'child_profile_id' => 'required|exists:child_profiles,id',
            'store_item_id' => 'required|exists:store_items,id',
        ]);

        $user = $request->user();
        $child = ChildProfile::findOrFail($request->child_profile_id);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $item = StoreItem::findOrFail($request->store_item_id);

               // Si el item es gratis (price = 0), se puede equipar sin comprarlo
        if ($item->price > 0) {
            $owned = ChildItem::where('child_profile_id', $child->id)
                ->where('store_item_id', $item->id)
                ->exists();

            if (! $owned) {
                return response()->json(['message' => 'No tienes este item'], 400);
            }
        }

        if ($item->category === 'avatar') {
            $child->equipped_avatar_id = $item->id;
            $child->avatar = $item->icon;
        } elseif ($item->category === 'accessory') {
            if ($child->equipped_accessory_id && $child->equipped_accessory_id_2) {
                $child->equipped_accessory_id = $child->equipped_accessory_id_2;
                $child->equipped_accessory_id_2 = $item->id;
            } elseif ($child->equipped_accessory_id) {
                $child->equipped_accessory_id_2 = $item->id;
            } else {
                $child->equipped_accessory_id = $item->id;
            }
        } elseif ($item->category === 'frame') {
            $child->equipped_frame_id = $item->id;
        }

        $child->save();

        return response()->json([
            'message' => '¡Item equipado!',
            'child' => $child->fresh([
                'equippedAvatar',
                'equippedAccessory',
                'equippedAccessory2',
                'equippedFrame',
            ]),
        ]);
    }

    /**
     * Quita un item equipado.
     */
    public function unequip(Request $request)
    {
        $request->validate([
            'child_profile_id' => 'required|exists:child_profiles,id',
            'category' => 'required|in:avatar,accessory,accessory2,frame',
        ]);

        $user = $request->user();
        $child = ChildProfile::findOrFail($request->child_profile_id);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $field = match ($request->category) {
            'avatar' => 'equipped_avatar_id',
            'accessory' => 'equipped_accessory_id',
            'accessory2' => 'equipped_accessory_id_2',
            'frame' => 'equipped_frame_id',
        };

        $child->$field = null;
        $child->save();

        return response()->json([
            'message' => 'Item desequipado',
            'child' => $child->fresh([
                'equippedAvatar',
                'equippedAccessory',
                'equippedAccessory2',
                'equippedFrame',
            ]),
        ]);
    }
}