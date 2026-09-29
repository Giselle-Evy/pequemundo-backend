<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class TrueFalseExerciseSeeder extends Seeder
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
                'title' => 'Verdadero o Falso: Animales',
                'question' => 'Los perros son mamíferos.',
                'instructions' => 'Toca V si es verdadero o F si es falso.',
                'correct_answer' => 'true',
                'order' => 15,
            ],
            [
                'subject' => $biologia,
                'title' => 'Verdadero o Falso: Plantas',
                'question' => 'Las plantas necesitan oscuridad para crecer.',
                'instructions' => 'Toca V si es verdadero o F si es falso.',
                'correct_answer' => 'false',
                'order' => 16,
            ],

            // ===== ESPAÑOL =====
            [
                'subject' => $espanol,
                'title' => 'Verdadero o Falso: Abecedario',
                'question' => 'La letra "A" es una vocal.',
                'instructions' => 'Toca V si es verdadero o F si es falso.',
                'correct_answer' => 'true',
                'order' => 15,
            ],
            [
                'subject' => $espanol,
                'title' => 'Verdadero o Falso: Sinónimos',
                'question' => '"Feliz" y "triste" son sinónimos.',
                'instructions' => 'Toca V si es verdadero o F si es falso.',
                'correct_answer' => 'false',
                'order' => 16,
            ],

            // ===== GEOGRAFÍA =====
            [
                'subject' => $geografia,
                'title' => 'Verdadero o Falso: Planetas',
                'question' => 'La Tierra es el tercer planeta del sistema solar.',
                'instructions' => 'Toca V si es verdadero o F si es falso.',
                'correct_answer' => 'true',
                'order' => 15,
            ],
            [
                'subject' => $geografia,
                'title' => 'Verdadero o Falso: Océanos',
                'question' => 'El océano Atlántico es el más grande del mundo.',
                'instructions' => 'Toca V si es verdadero o F si es falso.',
                'correct_answer' => 'false',
                'order' => 16,
            ],
        ];

        foreach ($exercises as $data) {
            if (! $data['subject']) continue;

            Exercise::create([
                'subject_id' => $data['subject']->id,
                'title' => $data['title'],
                'question' => $data['question'],
                'correct_answer' => $data['correct_answer'],
                'instructions' => $data['instructions'],
                'type' => 'true_false',
                'difficulty' => 'easy',
                'points_reward' => 15,
                'order' => $data['order'],
                'is_active' => true,
            ]);
        }
    }
}