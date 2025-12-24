<?php

namespace App\Filament\Resources\Pengaturans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PengaturanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        TextInput::make('name')
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
                        FileUpload::make('logo')
                            ->image()
                            ->directory('settings'),
                        FileUpload::make('favicon')
                            ->image()
                            ->directory('settings'),
                    ]),
                Section::make('Contact Details')
                    ->schema([
                        TextInput::make('kepala_instansi')
                            ->maxLength(255),
                        Textarea::make('alamat_instansi')
                            ->columnSpanFull(),
                        TextInput::make('no_telp_instansi')
                            ->tel()
                            ->maxLength(20),
                        TextInput::make('email_instansi')
                            ->email()
                            ->maxLength(255),
                    ]),
                Section::make('Social Media')
                    ->schema([
                        TextInput::make('facebook')
                            ->maxLength(255),
                        TextInput::make('twitter')
                            ->maxLength(255),
                        TextInput::make('instagram')
                            ->maxLength(255),
                        TextInput::make('youtube')
                            ->maxLength(255),
                    ]),
                Section::make('Map Coordinates')
                    ->schema([
                        TextInput::make('latitude')
                            ->numeric(),
                        TextInput::make('longitude')
                            ->numeric(),
                    ]),
            ]);
    }
}
