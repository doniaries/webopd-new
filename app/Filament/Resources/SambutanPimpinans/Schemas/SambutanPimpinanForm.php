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
                    ->hidden()
                    ->dehydrated(),
                TextInput::make('nama')
                    ->maxLength(255),
                TextInput::make('jabatan')
                    ->maxLength(255),
                FileUpload::make('foto')
                    ->label('Foto Pimpinan')
                    ->image()
                    ->disk('public')
                    ->directory('sambutan-pimpinan')
                    ->visibility('public')
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                    ->maxSize(2048)
                    ->helperText('Upload foto pimpinan (max 2MB). Format: JPEG, JPG, PNG'),
                RichEditor::make('isi_sambutan')
                    ->columnSpanFull(),
            ]);
    }
}
