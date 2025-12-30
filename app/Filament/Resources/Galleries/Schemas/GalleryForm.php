<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        \Filament\Forms\Components\FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->directory('galleries')
                            ->reorderable()
                            ->appendFiles()
                            ->columnSpanFull(),

                        DatePicker::make('published_at')
                            ->label('Tanggal Publish')
                            ->default(now()),
                    ])
            ]);
    }
}
