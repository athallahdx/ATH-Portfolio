<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::create([
            'name' => 'Primary Contact',
            'email' => 'hello@example.com',
            'whatsapp' => '+1 234 567 890',
            'linkedin' => 'https://linkedin.com/in/example',
            'github' => 'https://github.com/example',
            'instagram' => 'https://instagram.com/example',
        ]);
    }
}
