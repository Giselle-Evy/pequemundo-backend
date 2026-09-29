<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\ChildProfile;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Listar todos los logros disponibles (sin contar los del niño).
     */
    public function all()
    {
        return response()->json(Achievement::all());
    }

    /**
     * Listar todos los logros disponibles y cuáles ha ganado un niño.
     */
    public function show(Request $request, $childId)
    {
        $user = $request->user();
        $child = ChildProfile::findOrFail($childId);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $allAchievements = Achievement::all();
        $earnedIds = $child->achievements()->pluck('achievements.id')->toArray();

        $achievements = $allAchievements->map(function ($achievement) use ($earnedIds) {
            return [
                'id' => $achievement->id,
                'title' => $achievement->title,
                'description' => $achievement->description,
                'badge_icon' => $achievement->badge_icon,
                'earned' => in_array($achievement->id, $earnedIds),
            ];
        });

        return response()->json([
            'child' => $child,
            'achievements' => $achievements,
        ]);
    }
}