<?php

namespace App\Filament\Resources\Techstacks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TechstackForm
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
                FileUpload::make('icon')
                    ->directory('techstacks-icon')
                    ->imageEditor()
                    ->imageEditorAspectRatioOptions([
                        null,
                        '1:1',
                    ])
                    ->disk('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file, Get $get): string => Str::slug((string) $get('name') ?: 'techstack-icon')
                            . '.' . $file->guessExtension(),
                    )
                    ->visibility('public')
                    ->downloadable()
                    ->image(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
