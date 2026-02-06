<?php

namespace App\Filament\Resources\SambutanPimpinans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use App\Models\StrukturOrganisasi; // Added import

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
                Select::make('nama_pimpinan')
                    ->label('Nama Pimpinan')
                    ->options(fn() => StrukturOrganisasi::whereNotNull('pimpinan')->pluck('pimpinan', 'pimpinan'))
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('pimpinan')
                            ->required()
                            ->label('Nama Pimpinan Baru'),
                    ])
                    ->createOptionUsing(function ($data) {
                        return $data['pimpinan'];
                    }),
                FileUpload::make('foto_pimpinan')
                    ->label('Foto Pimpinan')
                    ->image()
                    ->directory('foto-pimpinan')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(2048),
                RichEditor::make('isi_sambutan')
                    ->columnSpanFull(),
            ]);
    }
}
