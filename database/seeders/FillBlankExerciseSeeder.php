<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class FillBlankExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $biologia = Subject::where('slug', 'biologia')->first();
        $espanol = Subject::where('slug', 'espanol')->first();
        $geografia = Subject::where('slug', 'geografia')->first();

        $exercises = [
            // ===== BIOLOGÍA =====
            [
                'subject' => $biologia,
                'title' => 'Completa: Animales',
                'question' => 'El ___ es un mamífero que ladra y mueve la cola.',
                'correct_answer' => 'perro',
                'order' => 14,
            ],
            [
                'subject' => $biologia,
                'title' => 'Completa: Plantas',
                'question' => 'Las plantas verdes hacen la ___ para producir su alimento.',
                'correct_answer' => 'fotosintesis',
                'order' => 15,
            ],

            // ===== ESPAÑOL =====
            [
                'subject' => $espanol,
                'title' => 'Completa: Vocales',
                'question' => 'Las cinco vocales son a, e, i, o, ___.',
                'correct_answer' => 'u',
                'order' => 14,
            ],
            [
                'subject' => $espanol,
                'title' => 'Completa: Sinónimos',
                'question' => 'Un sinónimo de "feliz" es ___.',
                'correct_answer' => 'contento',
                'order' => 15,
            ],

            // ===== GEOGRAFÍA =====
            [
                'subject' => $geografia,
                'title' => 'Completa: Planeta',
                'question' => 'La ___ es el planeta donde vivimos.',
                'correct_answer' => 'tierra',
                'order' => 14,
            ],
            [
                'subject' => $geografia,
                'title' => 'Completa: Océano',
                'question' => 'El océano más grande del mundo es el ___.',
                'correct_answer' => 'pacifico',
                'order' => 15,
            ],
        ];

        foreach ($exercises as $data) {
            if (! $data['subject']) continue;

            Exercise::create([
                'subject_id' => $data['subject']->id,
                'title' => $data['title'],
                'question' => $data['question'],
                'correct_answer' => $data['correct_answer'],
                'instructions' => 'Escribe la palabra que falta.',
                'type' => 'fill_blank',
                'difficulty' => 'medium',
                'points_reward' => 15,
                'order' => $data['order'],
                'is_active' => true,
            ]);
        }
    }
}