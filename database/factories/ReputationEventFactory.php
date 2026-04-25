<?php

namespace Database\Factories;

use App\Models\ReputationEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReputationEvent>
 */
class ReputationEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'event_type' => fake()->randomElement(['post_created', 'case_resolved', 'report_validated', 'community_help']),
            'points_delta' => fake()->numberBetween(-20, 150),
            'source_type' => null,
            'source_id' => null,
            'description' => fake()->optional()->sentence(),
            'metadata' => null,
            'occurred_at' => now(),
        ];
    }
}
