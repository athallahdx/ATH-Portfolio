<?php

namespace Database\Factories;

use App\Models\CurriculumVitae;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CurriculumVitae>
 */
class CurriculumVitaeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'version' => fake()->optional()->semver(),
            'file' => 'cv/'.fake()->uuid().'.pdf',
            'is_active' => true,
        ];
    }
}
