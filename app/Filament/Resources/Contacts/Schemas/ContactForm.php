<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('whatsapp')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('linkedin')
                    ->url()
                    ->maxLength(255),
                TextInput::make('github')
                    ->url()
                    ->maxLength(255),
                TextInput::make('instagram')
                    ->url()
                    ->maxLength(255),
            ]);
    }
}
