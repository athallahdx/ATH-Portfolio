<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::create(['name' => 'Web App', 'slug' => 'web-app', 'description' => 'Web App']);
        Tag::create(['name' => 'Mobile App', 'slug' => 'mobile-app', 'description' => 'Mobile App']);
        Tag::create(['name' => 'Machine Learning', 'slug' => 'machine-learning', 'description' => 'Machine Learning']);
        Tag::create(['name' => 'Blockchain', 'slug' => 'blockchain', 'description' => 'Blockchain']);
        Tag::create(['name' => 'Open Source', 'slug' => 'open-source', 'description' => 'Open Source']);
        Tag::create(['name' => 'API Development', 'slug' => 'api-development', 'description' => 'API Development']);
        Tag::create(['name' => 'Design / UX', 'slug' => 'design-ux', 'description' => 'Design / UX']);
        Tag::create(['name' => 'E-Commerce', 'slug' => 'e-commerce', 'description' => 'E-Commerce']);
        Tag::create(['name' => 'Real-time Chat', 'slug' => 'real-time-chat', 'description' => 'Real-time Chat']);
        Tag::create(['name' => 'Automation', 'slug' => 'automation', 'description' => 'Automation']);
    }
}
