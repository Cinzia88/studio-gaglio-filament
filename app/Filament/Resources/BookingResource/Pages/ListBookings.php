<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected static ?string $title = 'Prenotazioni';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nuova'),
        ];
    }
    public function getTabs(): array
    {
        return [
            'Tutti' => Tab::make(),
            'Agenzia Assicurazioni' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('service_id', 1)),
            'Corsi di formazione' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('service_id', 2)),
        ];
    }

    public function getDefaultActionTab(): string|int|null
    {
        return 'Tutti';
    }
}
