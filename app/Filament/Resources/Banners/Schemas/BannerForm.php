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
                    ->maxLength(255)
                    ->helperText('Link tujuan ketika banner diklik (opsional)'),
                FileUpload::make('gambar')
                    ->label('Gambar Banner')
                    ->image()
                    ->disk('public')
                    ->directory('banners')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:5',
                    ])
                    ->imageCropAspectRatio('4:5')
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                    ->maxSize(2048)
                    ->helperText('Upload gambar banner (max 2MB). Format: JPEG, JPG, PNG. Rekomendasi ukuran: 400x500px (Rasio 4:5).')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
