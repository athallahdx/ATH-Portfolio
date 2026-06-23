<?php

namespace Database\Factories;

use App\Models\Expertise;
use App\Models\ExpertiseElement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExpertiseElement>
 */
class ExpertiseElementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'expertise_id' => Expertise::factory(),
            'name' => fake()->word(),
            'icon' => fake()->optional()->word(),
            'description' => fake()->optional()->paragraph(),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
