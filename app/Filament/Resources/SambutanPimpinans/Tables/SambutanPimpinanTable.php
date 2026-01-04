<?php

namespace App\Filament\Resources\SambutanPimpinans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SambutanPimpinanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->visibility('public')
                    ->circular()
                    ->imageWidth(50)
                    ->imageHeight(50)
                    ->grow(false),
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jabatan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
