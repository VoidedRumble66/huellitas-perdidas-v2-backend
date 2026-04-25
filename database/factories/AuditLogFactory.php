<?php

namespace Database\Factories;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AuditLog>
 */
class AuditLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'actor_user_id' => User::factory(),
            'action' => fake()->randomElement(['create', 'update', 'delete', 'status_change']),
            'auditable_type' => fake()->randomElement(['posts', 'users', 'pets', 'organizations']),
            'auditable_id' => fake()->numberBetween(1, 5000),
            'old_values' => null,
            'new_values' => [
                'status' => fake()->randomElement(['draft', 'published', 'closed']),
            ],
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'occurred_at' => now(),
        ];
    }
}
