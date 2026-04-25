<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostShareAsset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PostShareAsset>
 */
class PostShareAssetFactory extends Factory
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
            'asset_type' => fake()->randomElement(['image', 'story', 'thumbnail']),
            'url' => fake()->imageUrl(),
            'width' => fake()->numberBetween(600, 1920),
            'height' => fake()->numberBetween(600, 1920),
            'status' => fake()->randomElement(['generated', 'queued', 'failed']),
            'generated_at' => now(),
        ];
    }
}
