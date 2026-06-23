<?php

namespace Database\Factories;

use App\Models\Description;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Description>
 */
class DescriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'label' => fake()->word(),
            'description' => fake()->optional()->paragraph(),
        ];
    }
}
