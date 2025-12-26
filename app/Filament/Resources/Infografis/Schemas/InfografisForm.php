<?php

namespace App\Filament\Resources\Infografis\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InfografisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->maxLength(255),
                FileUpload::make('gambar')
                    ->label('Gambar Infografis')
                    ->image()
                    ->disk('public')
                    ->directory('infografis')
                    ->visibility('public')
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                    ->maxSize(2048)
                    ->helperText('Upload gambar infografis (max 2MB). Format: JPEG, JPG, PNG'),
                \Filament\Forms\Components\Select::make('kategori')
                    ->searchable()
                    ->options(\App\Models\Tag::pluck('name', 'name'))
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return \App\Models\Tag::create($data)->name;
                    }),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
