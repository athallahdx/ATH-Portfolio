<?php

namespace App\Filament\Resources\PortfolioTypes\Pages;

use App\Filament\Resources\PortfolioTypes\PortfolioTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioType extends EditRecord
{
    protected static string $resource = PortfolioTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
