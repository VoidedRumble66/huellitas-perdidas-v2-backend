<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Models\Color;
use App\Models\Pet;
use App\Models\Species;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = Species::query()->inRandomOrder()->first();

        if (! $species) {
            $species = Species::query()->create([
                'name' => 'Otro',
                'slug' => 'otro',
                'description' => null,
                'active' => true,
            ]);
        }
        $breed = Breed::query()->where('species_id', $species->id)->inRandomOrder()->first();
        $mainColor = Color::query()->inRandomOrder()->first();
        $secondaryColor = Color::query()->where('id', '!=', optional($mainColor)->id)->inRandomOrder()->first();

        return [
            'owner_user_id' => User::factory(),
            'name' => fake()->optional()->firstName(),
            'species_id' => $species->id,
            'breed_id' => optional($breed)->id,
            'sex' => fake()->randomElement(['male', 'female', 'unknown']),
            'size' => fake()->randomElement(['small', 'medium', 'large', 'extra_large', 'unknown']),
            'main_color_id' => optional($mainColor)->id,
            'secondary_color_id' => optional($secondaryColor)->id,
            'birth_date' => fake()->optional()->dateTimeBetween('-15 years', '-2 months')?->format('Y-m-d'),
            'approximate_age' => fake()->optional()->randomElement(['2 meses', '6 meses', '1 año', '3 años', 'desconocida']),
            'distinctive_signs' => fake()->optional()->sentence(),
            'sterilized' => fake()->optional()->boolean(),
            'metadata' => null,
        ];
    }
}
