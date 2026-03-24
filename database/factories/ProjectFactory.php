<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'type' => fake()->randomElement(['app', 'research', 'course', 'project']),
            'status' => fake()->randomElement(['ongoing', 'completed']),
            'is_featured' => fake()->boolean(30),
            'url' => fake()->url(),
            'image_path' => null,
        ];
    }
}
