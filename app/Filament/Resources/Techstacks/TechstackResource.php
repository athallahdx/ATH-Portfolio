<?php

namespace App\Filament\Resources\Techstacks;

use App\Filament\Resources\Techstacks\Pages\CreateTechstack;
use App\Filament\Resources\Techstacks\Pages\EditTechstack;
use App\Filament\Resources\Techstacks\Pages\ListTechstacks;
use App\Filament\Resources\Techstacks\Schemas\TechstackForm;
use App\Filament\Resources\Techstacks\Tables\TechstacksTable;
use App\Models\Techstack;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TechstackResource extends Resource
{
    protected static ?string $model = Techstack::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TechstackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TechstacksTable::configure($table);
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
            'index' => ListTechstacks::route('/'),
            'create' => CreateTechstack::route('/create'),
            'edit' => EditTechstack::route('/{record}/edit'),
        ];
    }
}
