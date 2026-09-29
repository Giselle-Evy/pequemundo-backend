<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Subject;

class ExerciseController extends Controller
{
    // Listar todos los ejercicios de una materia
    public function bySubject($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $exercises = $subject->exercises()
            ->with(['options', 'pairs'])
            ->orderBy('order')
            ->get();

        return response()->json([
            'subject' => $subject,
            'exercises' => $exercises,
        ]);
    }

    // Ver un ejercicio específico con sus opciones y pares
    public function show($id)
    {
        $exercise = Exercise::with(['options', 'pairs'])->findOrFail($id);

        return response()->json($exercise);
    }
}