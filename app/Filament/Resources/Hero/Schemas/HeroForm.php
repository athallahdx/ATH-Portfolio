<?php

namespace App\Filament\Resources\Hero\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class HeroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('position')
                    ->required(),
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('hero')
                    ->imageEditor()
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file, Get $get): string => Str::slug((string) $get('position') ?: 'hero')
                            . '.' . $file->guessExtension(),
                    )
                    ->acceptedFileTypes(['image/*'])
                    ->visibility('public')
                    ->downloadable()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}