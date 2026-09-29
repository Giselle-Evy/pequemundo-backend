<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Biología',
                'slug' => 'biologia',
                'icon' => '🧬',
                'color' => '#81C784',
                'description' => 'Aprende sobre los seres vivos, animales, plantas y el cuerpo humano.',
                'order' => 1,
            ],
            [
                'name' => 'Español',
                'slug' => 'espanol',
                'icon' => '📚',
                'color' => '#FF8A65',
                'description' => 'Vocales, sílabas, palabras, sinónimos y comprensión lectora.',
                'order' => 2,
            ],
            [
                'name' => 'Geografía',
                'slug' => 'geografia',
                'icon' => '🌎',
                'color' => '#4FC3F7',
                'description' => 'Planeta Tierra, continentes, océanos, México y mapas.',
                'order' => 3,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(['slug' => $subject['slug']], $subject);
        }
    }
}