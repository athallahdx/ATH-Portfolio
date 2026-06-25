<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Basic Information Section
                Section::make('Basic Information')
                    ->description('Project title, description, and overview')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                // Project Timeline Section
                Section::make('Project Timeline')
                    ->description('When did this project run?')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('start_date'),

                        DatePicker::make('end_date'),
                    ]),

                // Project Details Section
                Section::make('Project Details')
                    ->description('Type, technologies, and tags')
                    ->columns(2)
                    ->schema([
                        Select::make('type_id')
                            ->relationship('type', 'name')
                            ->required(),

                        Toggle::make('is_active')
                            ->required()
                            ->inline(),

                        Select::make('techstacks')
                            ->relationship('techstacks', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),

                        Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ]),

                // Links & References Section
                Section::make('Links & References')
                    ->description('Project URL and contributions')
                    ->columns(1)
                    ->schema([
                        TextInput::make('url')
                            ->label('Project URL')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        KeyValue::make('contributions')
                            ->columnSpanFull(),
                    ]),

                // Portfolio Images Section
                Section::make('Portfolio Images')
                    ->description('Upload and manage project images')
                    ->schema([
                        Repeater::make('images')
                            ->relationship()
                            ->schema([
                                FileUpload::make('image')
                                    ->directory('portfolio-images')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->image()
                                    ->downloadable()
                                    ->columnSpanFull(),

                                TextInput::make('label')
                                    ->label('Image Label/Caption')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                TextInput::make('sort_order')
                                    ->label('Display Order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->collapsible()
                            ->collapsed()
                            ->cloneable()
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
