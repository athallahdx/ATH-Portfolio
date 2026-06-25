<?php

namespace App\Filament\Resources\CurriculumVitaes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CurriculumVitaeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('version')
                    ->maxLength(255),
                FileUpload::make('file')
                    ->required()
                    ->directory('cvs')
                    ->disk('public')
                    ->visibility('public')
                    ->downloadable(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
