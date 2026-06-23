<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioImage>
 */
class PortfolioImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'portfolio_id' => Portfolio::factory(),
            'image' => fake()->optional()->imageUrl(),
            'label' => fake()->optional()->word(),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
