<?php

namespace Database\Factories;

use App\Models\Expertise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Expertise>
 */
class ExpertiseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->optional()->paragraph(),
            'sort_order' => fake()->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}
