<?php

namespace App\Http\Controllers;

use App\Models\ChildProfile;
use App\Models\Progress;
use App\Models\Subject;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function show(Request $request, $childId)
    {
        $user = $request->user();
        $child = ChildProfile::findOrFail($childId);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $subjects = Subject::withCount('exercises')->orderBy('order')->get();

        $subjectProgress = $subjects->map(function ($subject) use ($child) {
            $totalExercises = $subject->exercises_count;

            // IDs de los ejercicios completados en esta materia
            $completedExerciseIds = Progress::where('child_profile_id', $child->id)
                ->where('completed', true)
                ->whereHas('exercise', function ($q) use ($subject) {
                    $q->where('subject_id', $subject->id);
                })
                ->pluck('exercise_id')
                ->toArray();

            $completed = count($completedExerciseIds);

            return [
                'subject_id' => $subject->id,
                'subject_name' => $subject->name,
                'icon' => $subject->icon,
                'color' => $subject->color,
                'total' => $totalExercises,
                'completed' => $completed,
                'completed_exercise_ids' => $completedExerciseIds,
                'percentage' => $totalExercises > 0 ? round(($completed / $totalExercises) * 100) : 0,
            ];
        });

        return response()->json([
            'child' => $child,
            'total_points' => $child->total_points,
            'subjects' => $subjectProgress,
        ]);
    }

    public function history(Request $request, $childId)
    {
        $user = $request->user();
        $child = ChildProfile::findOrFail($childId);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $history = Progress::where('child_profile_id', $child->id)
            ->where('completed', true)
            ->with(['exercise.subject'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($progress) {
                return [
                    'progress_id' => $progress->id,
                    'exercise_id' => $progress->exercise_id,
                    'exercise_title' => $progress->exercise?->title ?? 'Ejercicio',
                    'subject_name' => $progress->exercise?->subject?->name ?? 'Materia',
                    'subject_icon' => $progress->exercise?->subject?->icon ?? '📖',
                    'score' => $progress->score,
                    'completed_at' => $progress->updated_at,
                ];
            });

        return response()->json([
            'child' => $child,
            'history' => $history,
        ]);
    }
}