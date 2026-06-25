<?php

namespace App\Filament\Resources\Expertises\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExpertiseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('description')
                    ->rows(3),
                Toggle::make('is_active')
                    ->label('Is Active')
                    ->required(),
                Repeater::make('elements')
                    ->relationship()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('icon')
                            ->directory('expertise-elements-icon')
                            ->visibility('public')
                            ->disk('public')
                            ->downloadable()
                            ->image(),
                        Textarea::make('description')
                            ->rows(3),
                        TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->collapsible()
                    ->cloneable()
                    ->reorderable()
                    ->columnSpanFull(),
            ]);
    }
}
