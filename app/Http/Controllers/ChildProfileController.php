<?php

namespace App\Http\Controllers;

use App\Models\ChildProfile;
use Illuminate\Http\Request;

class ChildProfileController extends Controller
{
    public function index(Request $request)
    {
        $children = $request->user()
            ->childProfiles()
            ->with(['equippedAvatar', 'equippedAccessory', 'equippedAccessory2', 'equippedFrame'])
            ->get();

        return response()->json($children);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:5|max:11',
            'avatar' => 'nullable|string',
        ]);

        $profile = $request->user()->childProfiles()->create([
            'name' => $request->name,
            'age' => $request->age,
            'avatar' => $request->avatar ?? '🦊',
        ]);

        $profile->load(['equippedAvatar', 'equippedAccessory', 'equippedAccessory2', 'equippedFrame']);

        return response()->json([
            'message' => 'Perfil creado con éxito',
            'profile' => $profile,
        ], 201);
    }
}