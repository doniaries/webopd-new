<?php

namespace App\Filament\Resources\SambutanPimpinans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SambutanPimpinanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
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
                TextInput::make('nama')
                    ->maxLength(255),
                TextInput::make('jabatan')
                    ->maxLength(255),
                FileUpload::make('foto')
                    ->image()
                    ->directory('sambutan'),
                RichEditor::make('isi_sambutan')
                    ->columnSpanFull(),
            ]);
    }
}
