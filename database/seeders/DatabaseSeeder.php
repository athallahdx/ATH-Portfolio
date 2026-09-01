<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        /** User Admin Creation */
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        /** Call other seeders */
        $this->call([
            PortfolioTypeSeeder::class,
            TagSeeder::class,
            TechstackSeeder::class,
            PortfolioSeeder::class,
            ExpertiseSeeder::class,
            ContactSeeder::class,
            CurriculumVitaeSeeder::class,
            AboutMeSeeder::class,
        ]);
    }
}
