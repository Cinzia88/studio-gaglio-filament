<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Slot;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'zondicon-calendar';

    protected static ?string $navigationLabel = 'Prenotazioni';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {

        //vhjjhg
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'nome')
                    ->label('Utente')
                    ->getOptionLabelFromRecordUsing(fn(Customer $record) => "{$record->nome} {$record->cognome}")
                    ->required(),
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'nome')
                    ->label('Servizio')
                    ->live(debounce: 500)
                    ->required(),
                Forms\Components\DatePicker::make('data')
                    ->displayFormat('M d, Y')
                    ->required()
                    ->label('Data')
                    ->disabled(fn(Get $get): bool => ! filled($get('service_id')))
                    ->live(debounce: 500)
                    ->required(),
                Forms\Components\Select::make('slot_id')
                    ->relationship('slot', 'ora')
                    ->label('Fascia Oraria')
                    ->required()
                    ->disableOptionWhen(function ($value, $get) {

                        $bookings = Booking::where('data', $get('data'))
                            ->where('service_id', $get('service_id'))
                            ->pluck('slot_id')->toArray();

                        foreach ($bookings as $booking) {
                            if ($booking == $value) {
                                return true;
                            }
                        }
                    })
                    ->options(function (Get $get) {

                        $times = Slot::where('giorno', Carbon::parse($get('data'))->locale('it')->dayName)
                            ->where('service_id', $get('service_id'))
                            ->pluck('ora', 'id');

                        return $times;
                    })
                    ->disabled(fn(Get $get): bool => ! filled($get('data')))
                    ->required(),
                Forms\Components\TextArea::make('messaggio')
                    ->columnSpanFull()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.nome')
                    ->formatStateUsing(function ($state, Booking $booking) {
                        return $booking->customer->nome . ' ' . $booking->customer->cognome;
                    })
                    ->label('Utente'),
                Tables\Columns\TextColumn::make('service.nome')
                    ->label('Servizio'),
                Tables\Columns\TextColumn::make('data')
                    ->date()
                    ->label('Data'),
                Tables\Columns\TextColumn::make('slot.ora')
                    ->label('Fascia Oraria'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Prenotazioni';
    }
}
