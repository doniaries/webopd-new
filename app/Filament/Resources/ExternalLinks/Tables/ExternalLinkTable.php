<?php

namespace App\Filament\Resources\ExternalLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExternalLinkTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->visibility('public')
                    ->extraAttributes(fn($record) => [
                        'style' => \Illuminate\Support\Str::startsWith($record->logo, 'fa-') ? 'display: none;' : ''
                    ]),

                TextColumn::make('logo_icon')
                    ->label('Icon')
                    ->state(function ($record) {
                        return $record->logo;
                    })
                    ->formatStateUsing(function ($state) {
                        if (\Illuminate\Support\Str::startsWith($state, 'fa-')) {
                            return '<i class="' . $state . ' text-2xl"></i>';
                        }
                        return null;
                    })
                    ->html()
                    ->badge(false)
                    ->extraAttributes(fn($record) => [
                        'style' => !\Illuminate\Support\Str::startsWith($record->logo, 'fa-') ? 'display: none;' : ''
                    ]),

                TextColumn::make('nama_link')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->defaultPaginationPageOption(25)
            ->paginated([10, 25, 50, 'all']);
    }
}
