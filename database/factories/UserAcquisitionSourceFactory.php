<?php

namespace Database\Factories;

use App\Models\MarketingCampaign;
use App\Models\User;
use App\Models\UserAcquisitionSource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserAcquisitionSource>
 */
class UserAcquisitionSourceFactory extends Factory
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
            'marketing_campaign_id' => MarketingCampaign::factory(),
            'source' => fake()->randomElement(['facebook', 'instagram', 'google', 'direct']),
            'medium' => fake()->randomElement(['cpc', 'organic', 'social', 'email']),
            'campaign' => fake()->optional()->slug(2),
            'referrer_url' => fake()->optional()->url(),
            'landing_path' => '/'.fake()->slug(),
            'acquired_at' => now(),
            'metadata' => null,
        ];
    }
}
