<?php

namespace App\Filament\Resources\HolderResource\Pages;

use App\Filament\Resources\HolderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHolder extends EditRecord
{
    protected static string $resource = HolderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
