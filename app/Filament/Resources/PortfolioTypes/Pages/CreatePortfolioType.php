<?php

namespace App\Filament\Resources\PortfolioTypes\Pages;

use App\Filament\Resources\PortfolioTypes\PortfolioTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioType extends CreateRecord
{
    protected static string $resource = PortfolioTypeResource::class;
}
