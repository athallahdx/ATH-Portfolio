<?php

namespace App\Filament\Resources\AboutMe;

use App\Filament\Resources\AboutMe\Pages\CreateAboutMe;
use App\Filament\Resources\AboutMe\Pages\EditAboutMe;
use App\Filament\Resources\AboutMe\Pages\ListAboutMe;
use App\Filament\Resources\AboutMe\Schemas\AboutMeForm;
use App\Filament\Resources\AboutMe\Tables\AboutMeTable;
use App\Models\AboutMe;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutMeResource extends Resource
{
    protected static ?string $model = AboutMe::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static ?string $navigationLabel = 'About Me';

    protected static ?string $pluralModelLabel = 'About Me';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'About Me';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AboutMeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutMeTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutMe::route('/'),
            'create' => CreateAboutMe::route('/create'),
            'edit' => EditAboutMe::route('/{record}/edit'),
        ];
    }
}
