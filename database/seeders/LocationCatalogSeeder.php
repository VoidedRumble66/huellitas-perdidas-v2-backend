<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Neighborhood;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = State::query()->updateOrCreate(
            ['slug' => Str::slug('Chiapas')],
            [
                'name' => 'Chiapas',
                'code' => 'CHIS',
                'active' => true,
            ]
        );

        $municipality = Municipality::query()->updateOrCreate(
            [
                'state_id' => $state->id,
                'slug' => Str::slug('Ocosingo'),
            ],
            [
                'name' => 'Ocosingo',
                'active' => true,
            ]
        );

        $neighborhoods = [
            'Centro',
            'Norte',
            'Sur',
            'Barrio Guadalupe',
            'Barrio San Sebastián',
            'Barrio El Cerrito',
            'Barrio Candelaria',
            'Barrio Nuevo',
            'Lindavista',
            'Linda Vista',
            'El Rosario',
            'Nuevo México',
            'Toniná',
            'La Ceiba',
            'Otro',
        ];

        foreach ($neighborhoods as $name) {
            Neighborhood::query()->updateOrCreate(
                [
                    'municipality_id' => $municipality->id,
                    'slug' => Str::slug($name),
                ],
                [
                    'name' => $name,
                    'postal_code' => null,
                    'active' => true,
                ]
            );
        }
    }
}
