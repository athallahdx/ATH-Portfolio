<?php

namespace Database\Seeders;

use App\Models\AboutMe;
use Illuminate\Database\Seeder;

class AboutMeSeeder extends Seeder
{
    public function run(): void
    {
        AboutMe::create([
            'title' => 'Hero Intro',
            'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg',
            'description' => 'I am a Full Stack Developer dedicated to crafting clean, high-performance web applications. I specialize in building end-to-end solutions that merge sophisticated backend logic with intuitive, interactive user interfaces.',
        ]);

        AboutMe::create([
            'title' => 'About Me Details',
            'image' => '',
            'description' => 'I am a passionate software engineer with experience developing enterprise-grade systems and customer-centric platforms. My focus is on writing maintainable, well-tested code and implementing state-of-the-art UI/UX patterns that captivate users.',
        ]);
    }
}
