<?php

namespace App\Filament\Resources\Techstacks\Pages;

use App\Filament\Resources\Techstacks\TechstackResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTechstack extends EditRecord
{
    protected static string $resource = TechstackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
