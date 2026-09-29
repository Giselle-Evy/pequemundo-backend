<?php

namespace App\Http\Controllers;

use App\Models\ChildProfile;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * Ranking global de todos los niños.
     * Top 50 ordenados por puntos.
     */
    public function global()
    {
        $rankings = ChildProfile::query()
            ->select('id', 'name', 'avatar', 'total_points')
            ->orderBy('total_points', 'desc')
            ->limit(50)
            ->get()
            ->map(function ($child, $index) {
                return [
                    'position' => $index + 1,
                    'child_id' => $child->id,
                    'name' => $child->name,
                    'avatar' => $child->avatar,
                    'total_points' => $child->total_points,
                ];
            });

        return response()->json($rankings);
    }

    /**
     * Ranking entre los hermanos de un tutor.
     */
    public function family(Request $request)
    {
        $user = $request->user();

        $rankings = ChildProfile::where('user_id', $user->id)
            ->orderBy('total_points', 'desc')
            ->get()
            ->map(function ($child, $index) {
                return [
                    'position' => $index + 1,
                    'child_id' => $child->id,
                    'name' => $child->name,
                    'avatar' => $child->avatar,
                    'total_points' => $child->total_points,
                ];
            });

        return response()->json($rankings);
    }
}