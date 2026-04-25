<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Negro', 'hex' => '#000000'],
            ['name' => 'Blanco', 'hex' => '#FFFFFF'],
            ['name' => 'Café', 'hex' => '#8B4513'],
            ['name' => 'Gris', 'hex' => '#808080'],
            ['name' => 'Dorado', 'hex' => '#FFD700'],
            ['name' => 'Amarillo', 'hex' => '#FFFF00'],
            ['name' => 'Naranja', 'hex' => '#FFA500'],
            ['name' => 'Crema', 'hex' => '#FFFDD0'],
            ['name' => 'Manchado', 'hex' => null],
            ['name' => 'Atigrado', 'hex' => null],
            ['name' => 'Mixto', 'hex' => null],
            ['name' => 'Otro', 'hex' => null],
        ];

        foreach ($colors as $color) {
            Color::query()->updateOrCreate(
                ['slug' => Str::slug($color['name'])],
                [
                    'name' => $color['name'],
                    'hex' => $color['hex'],
                    'active' => true,
                ]
            );
        }
    }
}
