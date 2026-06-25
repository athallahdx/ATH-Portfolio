<?php

namespace App\Filament\Resources\Descriptions;

use App\Filament\Resources\Descriptions\Pages\CreateDescription;
use App\Filament\Resources\Descriptions\Pages\EditDescription;
use App\Filament\Resources\Descriptions\Pages\ListDescriptions;
use App\Filament\Resources\Descriptions\Schemas\DescriptionForm;
use App\Filament\Resources\Descriptions\Tables\DescriptionsTable;
use App\Models\Description;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DescriptionResource extends Resource
{
    protected static ?string $model = Description::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DescriptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DescriptionsTable::configure($table);
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
            'index' => ListDescriptions::route('/'),
            'create' => CreateDescription::route('/create'),
            'edit' => EditDescription::route('/{record}/edit'),
        ];
    }
}
