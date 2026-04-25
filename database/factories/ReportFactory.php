<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Report;
use App\Models\ReportReason;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reasonId = ReportReason::query()->inRandomOrder()->value('id');

        if (! $reasonId) {
            $reasonId = ReportReason::query()->create([
                'name' => 'Otro',
                'slug' => 'otro',
                'description' => 'Motivo genérico.',
                'applies_to' => ['posts', 'comments', 'sightings', 'users'],
                'active' => true,
            ])->id;
        }

        return [
            'reporter_user_id' => User::factory(),
            'reportable_type' => Post::class,
            'reportable_id' => Post::factory(),
            'report_reason_id' => $reasonId,
            'description' => fake()->optional()->sentence(),
            'status' => 'pending',
            'priority' => fake()->randomElement(['low', 'normal', 'high', 'critical']),
            'reviewed_by' => null,
            'reviewed_at' => null,
            'resolution_notes' => null,
            'metadata' => null,
        ];
    }
}
