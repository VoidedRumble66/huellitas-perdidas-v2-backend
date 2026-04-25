<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserActivityLog>
 */
class UserActivityLogFactory extends Factory
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
            'action' => fake()->randomElement(['login', 'logout', 'create_post', 'update_profile', 'send_report']),
            'target_type' => fake()->optional()->randomElement(['posts', 'pets', 'comments']),
            'target_id' => fake()->optional()->numberBetween(1, 5000),
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'metadata' => null,
            'occurred_at' => now(),
        ];
    }
}
