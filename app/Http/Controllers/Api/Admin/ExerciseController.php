<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        $query = Exercise::with('options');

        if ($request->has('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $exercises = $query->orderBy('order')->get();
        return response()->json($exercises);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'instructions' => 'nullable|string',
            'type' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'points_reward' => 'nullable|integer|min:1',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'options' => 'required|array|min:2',
            'options.*.option_text' => 'required|string',
            'options.*.is_correct' => 'required|boolean',
            'options.*.order' => 'nullable|integer',
        ]);

        $exercise = DB::transaction(function () use ($data) {
            $exercise = Exercise::create([
                'subject_id' => $data['subject_id'],
                'title' => $data['title'],
                'question' => $data['question'],
                'instructions' => $data['instructions'] ?? null,
                'type' => $data['type'] ?? 'multiple_choice',
                'difficulty' => $data['difficulty'] ?? 'easy',
                'points_reward' => $data['points_reward'] ?? 10,
                'order' => $data['order'] ?? 0,
                'is_active' => $data['is_active'] ?? true,
            ]);

            foreach ($data['options'] as $idx => $opt) {
                $exercise->options()->create([
                    'option_text' => $opt['option_text'],
                    'is_correct' => $opt['is_correct'],
                    'order' => $opt['order'] ?? ($idx + 1),
                ]);
            }

            return $exercise;
        });

        return response()->json([
            'message' => 'Ejercicio creado correctamente',
            'exercise' => $exercise->load('options'),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $exercise = Exercise::findOrFail($id);

        $data = $request->validate([
            'subject_id' => 'sometimes|exists:subjects,id',
            'title' => 'sometimes|string|max:255',
            'question' => 'sometimes|string',
            'instructions' => 'nullable|string',
            'type' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'points_reward' => 'nullable|integer|min:1',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'options' => 'sometimes|array|min:2',
            'options.*.option_text' => 'required_with:options|string',
            'options.*.is_correct' => 'required_with:options|boolean',
            'options.*.order' => 'nullable|integer',
        ]);

        DB::transaction(function () use ($exercise, $data) {
            $exercise->update([
                'subject_id' => $data['subject_id'] ?? $exercise->subject_id,
                'title' => $data['title'] ?? $exercise->title,
                'question' => $data['question'] ?? $exercise->question,
                'instructions' => $data['instructions'] ?? $exercise->instructions,
                'type' => $data['type'] ?? $exercise->type,
                'difficulty' => $data['difficulty'] ?? $exercise->difficulty,
                'points_reward' => $data['points_reward'] ?? $exercise->points_reward,
                'order' => $data['order'] ?? $exercise->order,
                'is_active' => $data['is_active'] ?? $exercise->is_active,
            ]);

            if (isset($data['options'])) {
                $exercise->options()->delete();
                foreach ($data['options'] as $idx => $opt) {
                    $exercise->options()->create([
                        'option_text' => $opt['option_text'],
                        'is_correct' => $opt['is_correct'],
                        'order' => $opt['order'] ?? ($idx + 1),
                    ]);
                }
            }
        });

        return response()->json([
            'message' => 'Ejercicio actualizado correctamente',
            'exercise' => $exercise->fresh()->load('options'),
        ]);
    }

    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();

        return response()->json([
            'message' => 'Ejercicio eliminado correctamente',
        ]);
    }
}