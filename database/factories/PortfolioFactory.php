<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\PortfolioType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Portfolio>
 */
class PortfolioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'start_date' => fake()->date(),
            'end_date' => fake()->optional()->date(),
            'url' => fake()->optional()->url(),
            'contributions' => fake()->optional()->randomElements(['Frontend', 'Backend', 'Database', 'DevOps', 'Design'], 2),
            'is_active' => true,
            'type_id' => PortfolioType::factory(),
        ];
    }
}
