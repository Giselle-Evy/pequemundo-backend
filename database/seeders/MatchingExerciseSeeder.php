<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\ExercisePair;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class MatchingExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $biologia = Subject::where('slug', 'biologia')->first();
        $espanol = Subject::where('slug', 'espanol')->first();
        $geografia = Subject::where('slug', 'geografia')->first();

        // ===== BIOLOGÍA: Animales y sus características =====
        if ($biologia) {
            $exercise = Exercise::create([
                'subject_id' => $biologia->id,
                'title' => 'Relaciona los animales',
                'question' => 'Une cada animal con su característica',
                'instructions' => 'Toca un animal y luego su característica para emparejarlos.',
                'type' => 'matching',
                'difficulty' => 'easy',
                'points_reward' => 20,
                'order' => 100,
                'is_active' => true,
            ]);

            $pairs = [
                ['left_text' => '🐶 Perro', 'right_text' => '🐾 Tiene pelo'],
                ['left_text' => '🐟 Pez', 'right_text' => '🌊 Vive en el agua'],
                ['left_text' => '🦅 Águila', 'right_text' => '🪶 Tiene plumas'],
                ['left_text' => '🐸 Rana', 'right_text' => '🌿 Vive en la tierra y el agua'],
            ];

            foreach ($pairs as $idx => $pair) {
                ExercisePair::create([
                    'exercise_id' => $exercise->id,
                    'left_text' => $pair['left_text'],
                    'right_text' => $pair['right_text'],
                    'order' => $idx + 1,
                ]);
            }
        }

        // ===== ESPAÑOL: Sinónimos =====
        if ($espanol) {
            $exercise = Exercise::create([
                'subject_id' => $espanol->id,
                'title' => 'Relaciona los sinónimos',
                'question' => 'Une cada palabra con su sinónimo',
                'instructions' => 'Toca una palabra y luego su sinónimo para emparejarlos.',
                'type' => 'matching',
                'difficulty' => 'easy',
                'points_reward' => 20,
                'order' => 100,
                'is_active' => true,
            ]);

            $pairs = [
                ['left_text' => 'Feliz', 'right_text' => 'Contento'],
                ['left_text' => 'Grande', 'right_text' => 'Enorme'],
                ['left_text' => 'Bonito', 'right_text' => 'Hermoso'],
                ['left_text' => 'Rápido', 'right_text' => 'Veloz'],
            ];

            foreach ($pairs as $idx => $pair) {
                ExercisePair::create([
                    'exercise_id' => $exercise->id,
                    'left_text' => $pair['left_text'],
                    'right_text' => $pair['right_text'],
                    'order' => $idx + 1,
                ]);
            }
        }

        // ===== GEOGRAFÍA: Países y capitales =====
        if ($geografia) {
            $exercise = Exercise::create([
                'subject_id' => $geografia->id,
                'title' => 'Relaciona los países',
                'question' => 'Une cada país con su continente',
                'instructions' => 'Toca un país y luego su continente para emparejarlos.',
                'type' => 'matching',
                'difficulty' => 'easy',
                'points_reward' => 20,
               'order' => 100,
                'is_active' => true,
            ]);

            $pairs = [
                ['left_text' => '🇲🇽 México', 'right_text' => '🌎 América'],
                ['left_text' => '🇫🇷 Francia', 'right_text' => '🌍 Europa'],
                ['left_text' => '🇧🇷 Brasil', 'right_text' => '🌎 América'],
                ['left_text' => '🇯🇵 Japón', 'right_text' => '🌏 Asia'],
            ];

            foreach ($pairs as $idx => $pair) {
                ExercisePair::create([
                    'exercise_id' => $exercise->id,
                    'left_text' => $pair['left_text'],
                    'right_text' => $pair['right_text'],
                    'order' => $idx + 1,
                ]);
            }
        }
    }
}