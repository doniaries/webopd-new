<?php

namespace App\Filament\Resources\Posts\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostGalleriesRelationManager extends RelationManager
{
    protected static string $relationship = 'galleries';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('keterangan')
                    ->label('Caption')
                    ->maxLength(255),
                FileUpload::make('file')
                    ->image()
                    ->directory('post-galleries')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('keterangan')
            ->columns([
                ImageColumn::make('file'),
                TextColumn::make('keterangan')
                    ->label('Caption')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),

            ]);
    }
}
