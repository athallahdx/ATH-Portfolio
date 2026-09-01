<?php

namespace App\Filament\Resources\CurriculumVitae;

use App\Filament\Resources\CurriculumVitae\Pages\CreateCurriculumVitae;
use App\Filament\Resources\CurriculumVitae\Pages\EditCurriculumVitae;
use App\Filament\Resources\CurriculumVitae\Pages\ListCurriculumVitae;
use App\Filament\Resources\CurriculumVitae\Schemas\CurriculumVitaeForm;
use App\Filament\Resources\CurriculumVitae\Tables\CurriculumVitaeTable;
use App\Models\CurriculumVitae;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CurriculumVitaeResource extends Resource
{
    protected static ?string $model = CurriculumVitae::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Curriculum Vitae';

    protected static ?string $pluralModelLabel = 'Curriculum Vitae';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Curriculum Vitae';

    public static function form(Schema $schema): Schema
    {
        return CurriculumVitaeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurriculumVitaeTable::configure($table);
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
            'index' => EditCurriculumVitae::route('/'),
        ];
    }
}
