<?php

namespace Database\Seeders;

use App\Models\CurriculumVitae;
use Illuminate\Database\Seeder;

class CurriculumVitaeSeeder extends Seeder
{
    public function run(): void
    {
        CurriculumVitae::create([
            'name' => 'CV - Full Stack Developer',
            'version' => '1.0.0',
            'file' => 'cv/cv-main.pdf',
            'is_active' => true,
        ]);

        CurriculumVitae::create([
            'name' => 'CV - Backend Developer',
            'version' => '1.0.0',
            'file' => 'cv/cv-backend.pdf',
            'is_active' => false,
        ]);
    }
}
