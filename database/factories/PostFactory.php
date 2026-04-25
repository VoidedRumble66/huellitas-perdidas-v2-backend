<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Pet;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_user_id' => User::factory(),
            'pet_id' => fake()->boolean(80) ? Pet::factory() : null,
            'post_type' => fake()->randomElement(['lost', 'found', 'adoption', 'care_tip', 'alert']),
            'status' => fake()->randomElement(['draft', 'pending_review', 'published']),
            'visibility' => fake()->randomElement(['public', 'private', 'hidden']),
            'title' => fake()->sentence(6),
            'description' => fake()->optional()->paragraph(),
            'location_id' => fake()->boolean(70) ? Location::query()->inRandomOrder()->value('id') : null,
            'contact_method' => fake()->randomElement(['platform', 'whatsapp', 'phone', 'hidden']),
            'contact_phone' => fake()->optional()->phoneNumber(),
            'contact_whatsapp' => fake()->optional()->phoneNumber(),
            'expires_at' => fake()->optional()->dateTimeBetween('now', '+60 days'),
            'published_at' => fake()->optional()->dateTimeBetween('-30 days', 'now'),
            'resolved_at' => null,
            'rejection_reason' => null,
            'metadata' => null,
        ];
    }
}
