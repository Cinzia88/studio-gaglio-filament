<?php

namespace App\Filament\Resources\SlotResource\Pages;

use App\Filament\Resources\SlotResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSlot extends CreateRecord
{
    protected static string $resource = SlotResource::class;

    protected static ?string $title = 'Nuovo Slot';

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
