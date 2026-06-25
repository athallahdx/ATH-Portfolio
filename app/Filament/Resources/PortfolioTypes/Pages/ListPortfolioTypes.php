<?php

namespace App\Filament\Resources\PortfolioTypes\Pages;

use App\Filament\Resources\PortfolioTypes\PortfolioTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioTypes extends ListRecords
{
    protected static string $resource = PortfolioTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
