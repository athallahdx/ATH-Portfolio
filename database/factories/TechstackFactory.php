<?php

namespace Database\Factories;

use App\Models\Techstack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Techstack>
 */
class TechstackFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'icon' => fake()->optional()->word(),
            'sort_order' => fake()->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}
