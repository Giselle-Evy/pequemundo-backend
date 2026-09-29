<?php

namespace Database\Seeders;

use App\Models\StoreItem;
use Illuminate\Database\Seeder;

class AvatarStoreSeeder extends Seeder
{
    public function run(): void
    {
        // Avatares GRATIS que faltan (los que ya están en AVATAR_OPTIONS pero no en la BD)
        $freeAvatars = [
            ['name' => 'Ranita', 'icon' => '🐸', 'price' => 0],
            ['name' => 'Pulpo', 'icon' => '🐙', 'price' => 0],
            ['name' => 'Dragón', 'icon' => '🐲', 'price' => 0],
            ['name' => 'Dino', 'icon' => '🦖', 'price' => 0],
            ['name' => 'Pingüino', 'icon' => '🐧', 'price' => 0],
            ['name' => 'Tortuga', 'icon' => '🐢', 'price' => 0],
            ['name' => 'Mariposa', 'icon' => '🦋', 'price' => 0],
            ['name' => 'Abejita', 'icon' => '🐝', 'price' => 0],
        ];

        // Avatares PREMIUM nuevos (no están en AVATAR_OPTIONS)
        $premiumAvatars = [
            ['name' => 'Jirafa', 'icon' => '🦒', 'price' => 20],
            ['name' => 'Cebra', 'icon' => '🦓', 'price' => 20],
            ['name' => 'Elefante', 'icon' => '🐘', 'price' => 25],
            ['name' => 'Rinoceronte', 'icon' => '🦏', 'price' => 25],
            ['name' => 'Camello', 'icon' => '🐪', 'price' => 20],
            ['name' => 'Canguro', 'icon' => '🦘', 'price' => 20],
            ['name' => 'Perezoso', 'icon' => '🦥', 'price' => 25],
            ['name' => 'Nutria', 'icon' => '🦦', 'price' => 20],
            ['name' => 'Zorrillo', 'icon' => '🦨', 'price' => 20],
            ['name' => 'Flamenco', 'icon' => '🦩', 'price' => 25],
            ['name' => 'Loro', 'icon' => '🦜', 'price' => 20],
            ['name' => 'Pavo real', 'icon' => '🦚', 'price' => 30],
            ['name' => 'Ballena', 'icon' => '🐳', 'price' => 25],
            ['name' => 'Tiburón', 'icon' => '🦈', 'price' => 25],
            ['name' => 'Cocodrilo', 'icon' => '🐊', 'price' => 25],
        ];

        $all = array_merge($freeAvatars, $premiumAvatars);

        foreach ($all as $avatar) {
            StoreItem::updateOrCreate(
                ['icon' => $avatar['icon'], 'category' => 'avatar'],
                [
                    'name' => $avatar['name'],
                    'category' => 'avatar',
                    'price' => $avatar['price'],
                    'is_active' => true,
                ]
            );
        }
    }
}