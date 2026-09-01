<?php

namespace App\Filament\Resources\CurriculumVitae\Schemas;

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
                FileUpload::make('cv')
                    ->required()
                    ->directory('cv')
                    ->disk('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->visibility('public')
                    ->downloadable(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
