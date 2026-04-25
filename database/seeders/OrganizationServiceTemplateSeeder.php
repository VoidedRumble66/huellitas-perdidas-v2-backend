<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\OrganizationService;
use Illuminate\Database\Seeder;

class OrganizationServiceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            'Consulta veterinaria',
            'Vacunación',
            'Esterilización',
            'Desparasitación',
            'Urgencias veterinarias',
            'Resguardo temporal',
            'Adopción responsable',
            'Recepción de donaciones',
        ];

        $organizations = Organization::query()->get();

        foreach ($organizations as $organization) {
            foreach ($templates as $serviceName) {
                OrganizationService::query()->updateOrCreate(
                    [
                        'organization_id' => $organization->id,
                        'service_name' => $serviceName,
                    ],
                    [
                        'description' => null,
                        'estimated_cost' => null,
                        'currency' => 'MXN',
                        'active' => true,
                        'metadata' => [
                            'source' => 'template',
                        ],
                    ]
                );
            }
        }
    }
}
