<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Utenti';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->readOnly(true)

                    ->maxLength(255),
                Forms\Components\TextInput::make('cognome')
                    ->required()
                    ->readOnly(true)

                    ->maxLength(255),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->required()
                    ->readOnly(true)

                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->readOnly(true)
                    ->required()
                    ->maxLength(255),

                //Forms\Components\DateTimePicker::make('email_verified_at'),
                /* Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255), */
                    Forms\Components\Toggle::make('tesserato')
                    ->live()
                        ->label('Tesserato'),
                        Forms\Components\TextInput::make('n_tessera')
                        ->visible(function (Forms\Get $get) {
                            return $get('tesserato') == true;
                        })
                        ->label('N° Tessera'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cognome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                    Tables\Columns\IconColumn::make('tesserato')
                    ->boolean(),
              /*   Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), */

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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Utenti';
    }
}
