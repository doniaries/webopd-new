<?php

namespace App\Filament\Resources\Dokumens\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DokumenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->disk('public')
                    ->visibility('public'),
                TextColumn::make('nama_dokumen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tahun_terbit')
                    ->date()
                    ->sortable(),
                TextColumn::make('downloads')
                    ->sortable(),
                TextColumn::make('views')
                    ->sortable(),
                // TextColumn::make('published_at')
                //     ->dateTime()
                //     ->sortable(),
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
