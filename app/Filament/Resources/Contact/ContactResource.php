<?php

namespace App\Filament\Resources\Contact;

use App\Filament\Resources\Contact\Pages\CreateContact;
use App\Filament\Resources\Contact\Pages\EditContact;
use App\Filament\Resources\Contact\Pages\ListContact;
use App\Filament\Resources\Contact\Schemas\ContactForm;
use App\Filament\Resources\Contact\Tables\ContactTable;
use App\Models\Contact;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $navigationLabel = 'Contact';

    protected static ?string $pluralModelLabel = 'Contact';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Contact';

    public static function form(Schema $schema): Schema
    {
        return ContactForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactTable::configure($table);
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
            'index' => EditContact::route('/'),
        ];
    }
}
