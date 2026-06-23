<?php

namespace Database\Factories;

use App\Models\PortfolioType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioType>
 */
class PortfolioTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->optional()->sentence(),
            'is_active' => true,
        ];
    }
}
