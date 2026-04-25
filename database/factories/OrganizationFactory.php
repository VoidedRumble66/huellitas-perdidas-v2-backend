<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'owner_user_id' => User::factory(),
            'organization_type' => fake()->randomElement(['shelter', 'veterinary', 'association', 'store', 'rescuer_group', 'other']),
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numerify('###'),
            'email' => fake()->optional()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'whatsapp' => fake()->optional()->phoneNumber(),
            'description' => fake()->optional()->paragraph(),
            'logo_path' => null,
            'status' => fake()->randomElement(['pending_review', 'approved', 'inactive']),
            'location_id' => Location::query()->inRandomOrder()->value('id'),
            'website_url' => fake()->optional()->url(),
            'facebook_url' => fake()->optional()->url(),
            'instagram_url' => fake()->optional()->url(),
            'verified_at' => null,
            'approved_by' => null,
            'approved_at' => null,
            'rejected_at' => null,
            'rejection_reason' => null,
            'metadata' => null,
        ];
    }
}
