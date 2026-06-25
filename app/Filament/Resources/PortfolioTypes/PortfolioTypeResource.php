<?php

namespace App\Filament\Resources\PortfolioTypes;

use App\Filament\Resources\PortfolioTypes\Pages\CreatePortfolioType;
use App\Filament\Resources\PortfolioTypes\Pages\EditPortfolioType;
use App\Filament\Resources\PortfolioTypes\Pages\ListPortfolioTypes;
use App\Filament\Resources\PortfolioTypes\Schemas\PortfolioTypeForm;
use App\Filament\Resources\PortfolioTypes\Tables\PortfolioTypesTable;
use App\Models\PortfolioType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortfolioTypeResource extends Resource
{
    protected static ?string $model = PortfolioType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PortfolioTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortfolioTypesTable::configure($table);
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
            'index' => ListPortfolioTypes::route('/'),
            'create' => CreatePortfolioType::route('/create'),
            'edit' => EditPortfolioType::route('/{record}/edit'),
        ];
    }
}
