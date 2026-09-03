<?php

namespace App\Filament\Resources\AboutMe\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AboutMeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('about-me')
                    ->imageEditor()
                    ->imageEditorAspectRatioOptions([
                        null,
                        '4:5',
                        '2:3',
                        '3:4'
                    ])
                    ->acceptedFileTypes(['image/*'])
                    ->visibility('public')
                    ->downloadable()
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file, Get $get): string =>
                            Str::slug((string) $get('title') ?: 'about-me')
                            . '.' . $file->guessExtension(),
                        )   
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
