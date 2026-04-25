<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Post;
use App\Models\PostSighting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PostSighting>
 */
class PostSightingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'user_id' => fake()->boolean(85) ? User::factory() : null,
            'location_id' => Location::query()->inRandomOrder()->value('id'),
            'description' => fake()->paragraph(),
            'seen_at' => fake()->optional()->dateTimeBetween('-30 days', 'now'),
            'confidence_level' => fake()->randomElement(['low', 'medium', 'high']),
            'status' => 'pending',
            'reviewed_by' => null,
            'reviewed_at' => null,
            'metadata' => null,
        ];
    }
}
