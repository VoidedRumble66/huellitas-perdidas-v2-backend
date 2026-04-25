<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = [
            'Perro',
            'Gato',
            'Conejo',
            'Ave',
            'Tortuga',
            'Hámster',
            'Cuyo',
            'Pez',
            'Hurón',
            'Otro',
        ];

        foreach ($species as $name) {
            Species::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => null,
                    'active' => true,
                ]
            );
        }
    }
}
