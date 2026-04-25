<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrador general',
                'description' => 'Acceso total al sistema.',
            ],
            [
                'name' => 'moderator',
                'display_name' => 'Moderador',
                'description' => 'Gestiona reportes y contenido moderado.',
            ],
            [
                'name' => 'pet_owner',
                'display_name' => 'Dueño de mascota',
                'description' => 'Usuario propietario de mascotas registradas en la plataforma.',
            ],
            [
                'name' => 'rescuer',
                'display_name' => 'Rescatista',
                'description' => 'Usuario enfocado en rescate y seguimiento de casos.',
            ],
            [
                'name' => 'adopter',
                'display_name' => 'Adoptante',
                'description' => 'Usuario interesado en procesos de adopción.',
            ],
            [
                'name' => 'shelter',
                'display_name' => 'Refugio',
                'description' => 'Organización o refugio de animales.',
            ],
            [
                'name' => 'veterinary',
                'display_name' => 'Veterinaria',
                'description' => 'Centro o profesional veterinario.',
            ],
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate(
                ['name' => $role['name']],
                [
                    'display_name' => $role['display_name'],
                    'description' => $role['description'],
                ]
            );
        }
    }
}
