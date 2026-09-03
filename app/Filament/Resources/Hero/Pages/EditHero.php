<?php

namespace App\Filament\Resources\Hero\Pages;

use App\Filament\Resources\Hero\HeroResource;
use App\Models\Hero;
use Filament\Resources\Pages\EditRecord;

class EditHero extends EditRecord
{
    protected static string $resource = HeroResource::class;

    public function mount(int | string | null $record = null): void
    {
        $this->record = $record !== null
            ? Hero::query()->findOrFail($record)
            : Hero::query()->firstOrNew();

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        if (! $record->exists) {
            $record->fill($data);
            $record->save();

            return $record;
        }

        $record->update($data);

        return $record;
    }
}