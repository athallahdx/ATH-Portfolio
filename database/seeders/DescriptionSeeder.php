<?php

namespace Database\Seeders;

use App\Models\Description;
use Illuminate\Database\Seeder;

class DescriptionSeeder extends Seeder
{
    public function run(): void
    {
        Description::create([
            'label' => 'Hero Title',
            'description' => 'Full Stack Web Developer',
        ]);
        Description::create([
            'label' => 'Hero Subtitle',
            'description' => 'Building modern web applications with Laravel, Vue.js, and Tailwind CSS',
        ]);
        Description::create([
            'label' => 'About Me',
            'description' => 'Passionate full-stack developer with expertise in building scalable web applications. Experienced in the Laravel ecosystem, modern JavaScript frameworks, and cloud infrastructure.',
        ]);
    }
}
