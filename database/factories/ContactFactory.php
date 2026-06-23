<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->optional()->email(),
            'whatsapp' => fake()->optional()->phoneNumber(),
            'linkedin' => fake()->optional()->url(),
            'github' => fake()->optional()->url(),
            'instagram' => fake()->optional()->url(),
        ];
    }
}
