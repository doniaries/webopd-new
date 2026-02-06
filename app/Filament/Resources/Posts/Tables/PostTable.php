<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;

class PostTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['user']))
            ->columns([
                ImageColumn::make('foto_utama')
                    ->label('Foto Utama')
                    ->disk('public')
                    ->width(100),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'warning',
                    }),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                ToggleColumn::make('is_featured')
                    ->label('Slider'),
                auth()->user()?->hasRole('super_admin')
                    ? TextInputColumn::make('views')
                    ->type('number')
                    ->sortable()
                    : TextColumn::make('views')
                    ->sortable(),
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
            ->defaultSort('published_at', 'desc');
    }
}
