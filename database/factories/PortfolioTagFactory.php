<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\PortfolioTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioTag>
 */
class PortfolioTagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'portfolio_id' => Portfolio::factory(),
            'tag_id' => Tag::factory(),
        ];
    }
}
