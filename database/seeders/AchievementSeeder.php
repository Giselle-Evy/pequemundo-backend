<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'Primer paso',
                'description' => 'Completa tu primer ejercicio.',
                'badge_icon' => '🏆',
            ],
            [
                'title' => 'Primera materia',
                'description' => 'Completa una materia entera.',
                'badge_icon' => '🥇',
            ],
            [
                'title' => '10 ejercicios',
                'description' => 'Completa 10 ejercicios.',
                'badge_icon' => '⭐',
            ],
            [
                'title' => 'Gran explorador',
                'description' => 'Completa 20 ejercicios.',
                'badge_icon' => '🚀',
            ],
            [
                'title' => 'Maestro de PequeMundo',
                'description' => 'Completa los 30 ejercicios.',
                'badge_icon' => '👑',
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::updateOrCreate(
                ['title' => $achievement['title']],
                $achievement
            );
        }
    }
}
