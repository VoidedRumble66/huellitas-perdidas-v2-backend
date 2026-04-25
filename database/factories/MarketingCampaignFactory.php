<?php

namespace Database\Factories;

use App\Models\MarketingCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<MarketingCampaign>
 */
class MarketingCampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(100, 999),
            'channel' => fake()->randomElement(['meta_ads', 'google_ads', 'tiktok_ads', 'influencers']),
            'source' => fake()->randomElement(['facebook', 'instagram', 'google', 'tiktok']),
            'medium' => fake()->randomElement(['cpc', 'social', 'email']),
            'status' => fake()->randomElement(['draft', 'active', 'paused', 'completed']),
            'starts_at' => now()->subDays(fake()->numberBetween(1, 30)),
            'ends_at' => now()->addDays(fake()->numberBetween(1, 30)),
            'budget' => fake()->randomFloat(2, 100, 50000),
            'metadata' => null,
        ];
    }
}
