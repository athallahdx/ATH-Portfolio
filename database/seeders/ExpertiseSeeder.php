<?php

namespace Database\Seeders;

use App\Models\Expertise;
use Illuminate\Database\Seeder;

class ExpertiseSeeder extends Seeder
{
    public function run(): void
    {
        Expertise::create(['name' => 'Full Stack Development', 'description' => 'End-to-end web application development from database to user interface', 'sort_order' => 1, 'is_active' => true]);
        Expertise::create(['name' => 'Backend Development', 'description' => 'Server-side logic, API design, and database architecture', 'sort_order' => 2, 'is_active' => true]);
        Expertise::create(['name' => 'Frontend Development', 'description' => 'Responsive and interactive user interfaces', 'sort_order' => 3, 'is_active' => true]);
        Expertise::create(['name' => 'DevOps', 'description' => 'CI/CD, containerization, and cloud infrastructure', 'sort_order' => 4, 'is_active' => true]);
        Expertise::create(['name' => 'UI/UX Design', 'description' => 'User experience and interface design', 'sort_order' => 5, 'is_active' => true]);
    }
}
