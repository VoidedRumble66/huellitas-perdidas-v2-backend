<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\OrganizationService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrganizationService>
 */
class OrganizationServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'service_name' => fake()->randomElement([
                'Consulta veterinaria',
                'Vacunación',
                'Esterilización',
                'Desparasitación',
            ]),
            'description' => fake()->optional()->sentence(),
            'estimated_cost' => fake()->optional()->randomFloat(2, 50, 3000),
            'currency' => 'MXN',
            'active' => true,
            'metadata' => null,
        ];
    }
}
