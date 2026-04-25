<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\OrganizationSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrganizationSchedule>
 */
class OrganizationScheduleFactory extends Factory
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
            'day_of_week' => fake()->numberBetween(1, 7),
            'opens_at' => '09:00:00',
            'closes_at' => '18:00:00',
            'is_closed' => false,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
