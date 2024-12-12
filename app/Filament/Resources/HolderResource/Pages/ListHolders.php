<?php

namespace App\Filament\Resources\HolderResource\Pages;

use App\Filament\Resources\HolderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHolders extends ListRecords
{
    protected static string $resource = HolderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
