<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\PortfolioTechstack;
use App\Models\Techstack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioTechstack>
 */
class PortfolioTechstackFactory extends Factory
{
    public function definition(): array
    {
        return [
            'portfolio_id' => Portfolio::factory(),
            'techstack_id' => Techstack::factory(),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
