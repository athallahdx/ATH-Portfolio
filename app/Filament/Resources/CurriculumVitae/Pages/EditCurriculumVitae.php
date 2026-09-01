<?php

namespace App\Filament\Resources\CurriculumVitae\Pages;

use App\Filament\Resources\CurriculumVitae\CurriculumVitaeResource;
use App\Models\CurriculumVitae;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCurriculumVitae extends EditRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    public function mount(int | string | null $record = null): void
    {
        $this->record = $record !== null
            ? CurriculumVitae::query()->findOrFail($record)
            : CurriculumVitae::query()->firstOrNew();

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
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

    protected function getHeaderActions(): array
    {
        if (! $this->record instanceof \Illuminate\Database\Eloquent\Model || ! $this->record->exists) {
            return [];
        }

        return [
            DeleteAction::make(),
        ];
    }
}
