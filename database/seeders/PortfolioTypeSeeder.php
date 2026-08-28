<?php

namespace Database\Seeders;

use App\Models\PortfolioType;
use Illuminate\Database\Seeder;

class PortfolioTypeSeeder extends Seeder
{
    public function run(): void
    {
        PortfolioType::create(['name' => 'Web Application', 'description' => 'Full-stack web applications built with modern frameworks', 'is_active' => true]);
        PortfolioType::create(['name' => 'Mobile App', 'description' => 'Cross-platform and native mobile applications', 'is_active' => true]);
        PortfolioType::create(['name' => 'API', 'description' => 'RESTful and GraphQL API services', 'is_active' => true]);
        PortfolioType::create(['name' => 'Open Source Library', 'description' => 'Open source packages and libraries', 'is_active' => true]);
        PortfolioType::create(['name' => 'Landing Page', 'description' => 'Marketing and landing page websites', 'is_active' => true]);
    }
}
