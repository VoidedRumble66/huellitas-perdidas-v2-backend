<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserReputationSummary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserReputationSummary>
 */
class UserReputationSummaryFactory extends Factory
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
            'score' => fake()->numberBetween(0, 3000),
            'level' => fake()->randomElement(['bronze', 'silver', 'gold', 'platinum']),
            'posts_created_count' => fake()->numberBetween(0, 300),
            'helpful_reports_count' => fake()->numberBetween(0, 100),
            'resolved_cases_count' => fake()->numberBetween(0, 80),
            'last_calculated_at' => now(),
        ];
    }
}
