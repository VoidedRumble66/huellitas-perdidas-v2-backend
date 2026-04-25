<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\ShareEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ShareEvent>
 */
class ShareEventFactory extends Factory
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
            'post_id' => Post::factory(),
            'channel' => fake()->randomElement(['copy_link', 'whatsapp', 'facebook', 'instagram', 'x']),
            'platform' => fake()->optional()->randomElement(['ios', 'android', 'web']),
            'shared_at' => now(),
            'metadata' => null,
        ];
    }
}
