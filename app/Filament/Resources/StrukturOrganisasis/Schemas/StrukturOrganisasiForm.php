<?php

namespace App\Filament\Resources\StrukturOrganisasis\Schemas;


use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class StrukturOrganisasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Unit Kerja')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Unit')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->disabled()
                                    ->dehydrated(),

                                TextInput::make('pimpinan')
                                    ->label('Nama Pimpinan')
                                    ->maxLength(255),

                                TextInput::make('description')
                                    ->label('Keterangan Unit')
                                    ->columnSpanFull(),
                            ]),


                    ]),
            ]);
    }
}
