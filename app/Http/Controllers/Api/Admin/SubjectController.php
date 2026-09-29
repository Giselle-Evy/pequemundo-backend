<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::withCount('exercises')->orderBy('order')->get();
        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);

        $subject = Subject::create($data);

        return response()->json([
            'message' => 'Materia creada correctamente',
            'subject' => $subject,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'icon' => 'sometimes|nullable|string|max:10',
            'color' => 'sometimes|nullable|string|max:20',
            'description' => 'sometimes|nullable|string',
            'order' => 'sometimes|nullable|integer',
            'is_active' => 'sometimes|nullable|boolean',
        ]);

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $subject->update($data);

        return response()->json([
            'message' => 'Materia actualizada correctamente',
            'subject' => $subject->fresh(),
        ]);
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response()->json([
            'message' => 'Materia eliminada correctamente',
        ]);
    }
}