<?php

namespace App\Filament\Resources\Techstacks\Pages;

use App\Filament\Resources\Techstacks\TechstackResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTechstacks extends ListRecords
{
    protected static string $resource = TechstackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
