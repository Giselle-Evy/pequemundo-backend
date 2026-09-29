<?php

namespace Database\Seeders;

use App\Models\StoreItem;
use Illuminate\Database\Seeder;

class StoreItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // ===== AVATARES (ANIMALES) =====
            ['name' => 'Zorro', 'category' => 'avatar', 'icon' => '🦊', 'price' => 0],
            ['name' => 'Oso', 'category' => 'avatar', 'icon' => '🐻', 'price' => 20],
            ['name' => 'Conejo', 'category' => 'avatar', 'icon' => '🐰', 'price' => 30],
            ['name' => 'Panda', 'category' => 'avatar', 'icon' => '🐼', 'price' => 40],
            ['name' => 'Koala', 'category' => 'avatar', 'icon' => '🐨', 'price' => 40],
            ['name' => 'León', 'category' => 'avatar', 'icon' => '🦁', 'price' => 60],
            ['name' => 'Tigre', 'category' => 'avatar', 'icon' => '🐯', 'price' => 60],
            ['name' => 'Unicornio', 'category' => 'avatar', 'icon' => '🦄', 'price' => 100],

            // ===== ACCESORIOS =====
            ['name' => 'Lentes', 'category' => 'accessory', 'icon' => '👓', 'price' => 15],
            ['name' => 'Gorra', 'category' => 'accessory', 'icon' => '🧢', 'price' => 15],
            ['name' => 'Moño', 'category' => 'accessory', 'icon' => '🎀', 'price' => 20],
            ['name' => 'Gafas de sol', 'category' => 'accessory', 'icon' => '🕶️', 'price' => 25],
            ['name' => 'Sombrero', 'category' => 'accessory', 'icon' => '🎩', 'price' => 30],
            ['name' => 'Audífonos', 'category' => 'accessory', 'icon' => '🎧', 'price' => 30],
            ['name' => 'Birrete', 'category' => 'accessory', 'icon' => '🎓', 'price' => 40],
            ['name' => 'Corona', 'category' => 'accessory', 'icon' => '👑', 'price' => 75],

            // ===== MARCOS =====
            ['name' => 'Estrellas', 'category' => 'frame', 'icon' => '🌟', 'price' => 25],
            ['name' => 'Corazones', 'category' => 'frame', 'icon' => '💖', 'price' => 25],
            ['name' => 'Rayos', 'category' => 'frame', 'icon' => '⚡', 'price' => 40],
            ['name' => 'Arcoíris', 'category' => 'frame', 'icon' => '🌈', 'price' => 50],
        ];

        foreach ($items as $item) {
            StoreItem::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}