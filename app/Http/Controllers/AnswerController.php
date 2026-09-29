<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\ChildProfile;
use App\Models\Exercise;
use App\Models\Option;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnswerController extends Controller
{
    public function answer(Request $request, $exerciseId)
    {
        $exercise = Exercise::with(['options', 'pairs'])->findOrFail($exerciseId);

        $request->validate([
            'child_profile_id' => 'required|exists:child_profiles,id',
        ]);

        $user = $request->user();
        $child = ChildProfile::findOrFail($request->child_profile_id);

        if ($child->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $isCorrect = false;

        if ($exercise->type === 'matching') {
            $request->validate([
                'matches' => 'required|array|min:1',
                'matches.*.left' => 'required|string',
                'matches.*.right' => 'required|string',
            ]);

            $correctPairs = $exercise->pairs->map(function ($pair) {
                return ['left' => $pair->left_text, 'right' => $pair->right_text];
            })->toArray();

            $correctCount = 0;
            foreach ($request->matches as $userPair) {
                foreach ($correctPairs as $correctPair) {
                    if (
                        $userPair['left'] === $correctPair['left'] &&
                        $userPair['right'] === $correctPair['right']
                    ) {
                        $correctCount++;
                        break;
                    }
                }
            }
            $isCorrect = $correctCount === count($correctPairs);

        } elseif ($exercise->type === 'true_false') {
            $request->validate([
                'answer' => 'required|in:true,false',
            ]);
            $isCorrect = (string) $exercise->correct_answer === (string) $request->answer;

        } elseif ($exercise->type === 'fill_blank') {
            $request->validate([
                'answer' => 'required|string|max:255',
            ]);
            $userAnswer = Str::lower(trim($request->answer));
            $correctAnswer = Str::lower(trim($exercise->correct_answer ?? ''));
            $isCorrect = $userAnswer === $correctAnswer;

        } else {
            $request->validate([
                'option_id' => 'required|exists:options,id',
            ]);

            $option = Option::findOrFail($request->option_id);
            if ($option->exercise_id !== $exercise->id) {
                return response()->json(['message' => 'Opción inválida'], 422);
            }
            $isCorrect = $option->is_correct;
        }

        // === Guardar progreso ===
        $progress = Progress::firstOrNew([
            'child_profile_id' => $child->id,
            'exercise_id' => $exercise->id,
        ]);

        $pointsEarned = 0;

        if ($isCorrect) {
            if (! $progress->completed) {
                $pointsEarned = $exercise->points_reward;
                $child->total_points += $pointsEarned;
                $child->save();
            }
            $progress->completed = true;
            $progress->score = $exercise->points_reward;
        } else {
            $progress->score = 0;
        }

        $progress->save();

        // === Incrementar contador de ejercicios gratis si no está suscrito ===
        if (! $user->subscribed('default')) {
            $user->increment('free_exercises_used');
        }

        $newAchievements = $this->checkAchievements($child);

        return response()->json([
            'correct' => $isCorrect,
            'points_earned' => $pointsEarned,
            'total_points' => $child->total_points,
            'progress' => $progress,
            'new_achievements' => $newAchievements,
        ]);
    }

    private function checkAchievements(ChildProfile $child): array
    {
        $completedCount = Progress::where('child_profile_id', $child->id)
            ->where('completed', true)
            ->count();

        $completedBySubject = Progress::where('child_profile_id', $child->id)
            ->where('completed', true)
            ->join('exercises', 'progress.exercise_id', '=', 'exercises.id')
            ->selectRaw('exercises.subject_id, COUNT(*) as total')
            ->groupBy('exercises.subject_id')
            ->pluck('total', 'subject_id');

        $totalBySubject = Exercise::selectRaw('subject_id, COUNT(*) as total')
            ->groupBy('subject_id')
            ->pluck('total', 'subject_id');

        $criteria = [
            'Primer paso' => $completedCount >= 1,
            'Primera materia' => $completedBySubject->contains(function ($count, $subjectId) use ($totalBySubject) {
                $total = $totalBySubject[$subjectId] ?? 0;
                return $total > 0 && $count >= $total;
            }),
            '10 ejercicios' => $completedCount >= 10,
            'Gran explorador' => $completedCount >= 20,
            'Maestro de PequeMundo' => $completedCount >= 30,
        ];

        $newAchievements = [];

        foreach ($criteria as $title => $isMet) {
            if (! $isMet) continue;
            $achievement = Achievement::where('title', $title)->first();
            if (! $achievement) continue;
            $hasIt = $child->achievements()->where('achievement_id', $achievement->id)->exists();
            if ($hasIt) continue;
            $child->achievements()->attach($achievement->id);
            $newAchievements[] = [
                'id' => $achievement->id,
                'title' => $achievement->title,
                'description' => $achievement->description,
                'badge_icon' => $achievement->badge_icon,
            ];
        }

        return $newAchievements;
    }
}