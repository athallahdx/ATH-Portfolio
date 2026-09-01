<?php

namespace Database\Seeders;

use App\Models\CurriculumVitae;
use Illuminate\Database\Seeder;

class CurriculumVitaeSeeder extends Seeder
{
    public function run(): void
    {
        CurriculumVitae::create([
            'name' => 'CV - Main',
            'cv' => 'cv/cv-main.pdf',
            'is_active' => true,
        ]);
    }
}
