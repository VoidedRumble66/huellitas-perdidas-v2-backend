<?php

namespace Database\Factories;

use App\Models\AdoptionRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AdoptionRequest>
 */
class AdoptionRequestFactory extends Factory
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
            'applicant_user_id' => User::factory(),
            'status' => 'pending',
            'housing_type' => fake()->randomElement(['house', 'apartment', 'ranch', 'other', 'unknown']),
            'has_other_pets' => fake()->optional()->boolean(),
            'other_pets_description' => fake()->optional()->sentence(),
            'experience_with_pets' => fake()->optional()->paragraph(),
            'reason_for_adoption' => fake()->optional()->paragraph(),
            'responsible_adult_name' => fake()->optional()->name(),
            'contact_phone' => fake()->optional()->phoneNumber(),
            'contact_email' => fake()->optional()->safeEmail(),
            'notes' => fake()->optional()->sentence(),
            'selected_at' => null,
            'approved_at' => null,
            'rejected_at' => null,
            'cancelled_at' => null,
            'completed_at' => null,
            'reviewed_by' => null,
            'metadata' => null,
        ];
    }
}
