<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlotResource\Pages;
use App\Filament\Resources\SlotResource\RelationManagers;
use App\Models\Slot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlotResource extends Resource
{
    protected static ?string $model = Slot::class;


    protected static ?string $navigationIcon = 'entypo-time-slot';

    protected static ?string $navigationLabel = 'Slot';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'nome')
                    ->required(),
                Forms\Components\Select::make('giorno')
                    ->options([
                        'Lunedì' => 'Lunedì',
                        'Martedì' => 'Martedì',
                        'Mercoledì' => 'Mercoledì',
                        'Giovedì' => 'Giovedì',
                        'Venerdì' => 'Venerdì',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('ora')
                    ->seconds(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.nome')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('giorno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ora'),
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
            'index' => Pages\ListSlots::route('/'),
            'create' => Pages\CreateSlot::route('/create'),
            'edit' => Pages\EditSlot::route('/{record}/edit'),
        ];
    }
}
