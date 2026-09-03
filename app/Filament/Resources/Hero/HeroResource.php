<?php

namespace App\Filament\Resources\Hero;

use App\Filament\Resources\Hero\Pages\EditHero;
use App\Filament\Resources\Hero\Schemas\HeroForm;
use App\Filament\Resources\Hero\Tables\HeroTable;
use App\Models\Hero;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HeroForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HeroTable::configure($table);
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
            'index' => EditHero::route('/'),
        ];
    }
}