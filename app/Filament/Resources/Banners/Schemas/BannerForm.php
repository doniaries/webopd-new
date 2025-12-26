<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Banner')
                    ->maxLength(255)
                    ->helperText('Judul atau nama banner (opsional)'),
                TextInput::make('url')
                    ->label('URL Link')
                    ->url()
                    ->maxLength(255)
                    ->helperText('Link tujuan ketika banner diklik (opsional)'),
                // TextInput::make('order')
                //     ->label('Urutan')
                //     ->numeric()
                //     ->default(0)
                //     ->helperText('Urutan tampilan banner (semakin kecil semakin awal)'),
                FileUpload::make('gambar')
                    ->label('Gambar Banner')
                    ->image()
                    ->disk('public')
                    ->directory('banners')
                    ->visibility('public')
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                    ->maxSize(2048)
                    ->helperText('Upload gambar banner (max 2MB). Format: JPEG, JPG, PNG')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
