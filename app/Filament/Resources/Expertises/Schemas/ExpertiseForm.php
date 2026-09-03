<?php

namespace App\Filament\Resources\Expertises\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
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
                FileUpload::make('icon')
                    ->directory('expertise-icon')
                    ->visibility('public')
                    ->disk('public')
                    ->downloadable()
                    ->imageEditor()
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file, Get $get): string => Str::slug((string) $get('name') ?: 'expertise-icon')
                            . '.' . $file->guessExtension(),
                    )
                    ->imageEditorAspectRatioOptions([
                        null,
                        '1:1',
                    ])
                    ->image(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('description')
                    ->rows(3),
                Toggle::make('is_active')
                    ->label('Is Active')
                    ->required(),
            ]);
    }
}
