<?php

namespace Database\Seeders;

use App\Models\Techstack;
use Illuminate\Database\Seeder;

class TechstackSeeder extends Seeder
{
    public function run(): void
    {
        Techstack::create(['name' => 'TypeScript', 'slug' => 'typescript', 'icon' => 'typescript', 'sort_order' => 1, 'is_active' => true]);
        Techstack::create(['name' => 'JavaScript', 'slug' => 'javascript', 'icon' => 'javascript', 'sort_order' => 2, 'is_active' => true]);
        Techstack::create(['name' => 'PHP', 'slug' => 'php', 'icon' => 'php', 'sort_order' => 3, 'is_active' => true]);
        Techstack::create(['name' => 'Laravel', 'slug' => 'laravel', 'icon' => 'laravel', 'sort_order' => 4, 'is_active' => true]);
        Techstack::create(['name' => 'Vue.js', 'slug' => 'vuejs', 'icon' => 'vuejs', 'sort_order' => 5, 'is_active' => true]);
        Techstack::create(['name' => 'React', 'slug' => 'react', 'icon' => 'react', 'sort_order' => 6, 'is_active' => true]);
        Techstack::create(['name' => 'Tailwind CSS', 'slug' => 'tailwindcss', 'icon' => 'tailwindcss', 'sort_order' => 7, 'is_active' => true]);
        Techstack::create(['name' => 'MySQL', 'slug' => 'mysql', 'icon' => 'mysql', 'sort_order' => 8, 'is_active' => true]);
        Techstack::create(['name' => 'PostgreSQL', 'slug' => 'postgresql', 'icon' => 'postgresql', 'sort_order' => 9, 'is_active' => true]);
        Techstack::create(['name' => 'Docker', 'slug' => 'docker', 'icon' => 'docker', 'sort_order' => 10, 'is_active' => true]);
        Techstack::create(['name' => 'Git', 'slug' => 'git', 'icon' => 'git', 'sort_order' => 11, 'is_active' => true]);
        Techstack::create(['name' => 'Redis', 'slug' => 'redis', 'icon' => 'redis', 'sort_order' => 12, 'is_active' => true]);
        Techstack::create(['name' => 'Alpine.js', 'slug' => 'alpinejs', 'icon' => 'alpinejs', 'sort_order' => 13, 'is_active' => true]);
        Techstack::create(['name' => 'Filament', 'slug' => 'filament', 'icon' => 'filament', 'sort_order' => 14, 'is_active' => true]);
        Techstack::create(['name' => 'Inertia', 'slug' => 'inertia', 'icon' => 'inertia', 'sort_order' => 15, 'is_active' => true]);
    }
}
