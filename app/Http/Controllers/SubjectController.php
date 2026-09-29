<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Listar todas las materias con el número de ejercicios
    public function index()
    {
        $subjects = Subject::withCount('exercises')->get();

        return response()->json($subjects);
    }

    // Ver una materia con sus ejercicios y opciones
    public function show($id)
    {
        $subject = Subject::with('exercises.options')->findOrFail($id);

        return response()->json($subject);
    }
}