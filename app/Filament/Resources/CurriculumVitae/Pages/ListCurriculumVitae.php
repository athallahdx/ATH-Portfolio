<?php

namespace App\Filament\Resources\CurriculumVitae\Pages;

use App\Filament\Resources\CurriculumVitae\CurriculumVitaeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCurriculumVitae extends ListRecords
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
