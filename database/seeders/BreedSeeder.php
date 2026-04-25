<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\Species;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $breedsBySpecies = [
            'Perro' => [
                'Mestizo',
                'Chihuahua',
                'Labrador Retriever',
                'Golden Retriever',
                'Pastor Alemán',
                'Pitbull',
                'Husky Siberiano',
                'Poodle',
                'Schnauzer',
                'Bulldog',
                'Beagle',
                'Otro',
            ],
            'Gato' => [
                'Mestizo',
                'Siamés',
                'Persa',
                'Maine Coon',
                'Bengalí',
                'Angora',
                'Sphynx',
                'Otro',
            ],
            'Conejo' => [
                'Mestizo',
                'Mini Lop',
                'Cabeza de León',
                'Rex',
                'Holandés',
                'Otro',
            ],
            'Ave' => [
                'Perico',
                'Canario',
                'Loro',
                'Cotorro',
                'Gallina',
                'Otro',
            ],
            'Tortuga' => ['Otro'],
            'Hámster' => ['Otro'],
            'Cuyo' => ['Otro'],
            'Pez' => ['Otro'],
            'Hurón' => ['Otro'],
            'Otro' => ['Otro'],
        ];

        foreach ($breedsBySpecies as $speciesName => $breeds) {
            $species = Species::query()->where('name', $speciesName)->first();

            if (! $species) {
                continue;
            }

            foreach ($breeds as $breedName) {
                Breed::query()->updateOrCreate(
                    [
                        'species_id' => $species->id,
                        'slug' => Str::slug($breedName),
                    ],
                    [
                        'name' => $breedName,
                        'description' => null,
                        'active' => true,
                    ]
                );
            }
        }
    }
}
