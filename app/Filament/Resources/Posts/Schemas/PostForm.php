<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1: Content
                Section::make('Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Judul Berita')
                            ->maxLength(255)
                            ->placeholder('Masukkan judul berita')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->disabled()
                            ->dehydrated(),
                        RichEditor::make('content')
                            ->label('Konten Berita')
                            ->required()
                            ->placeholder('Tulis konten berita di sini...')
                            ->columnSpanFull(),
                        FileUpload::make('foto_utama')
                            ->label('Foto Utama')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                            ->maxSize(2048)
                            ->helperText('Upload foto utama (max 2MB). Format: JPEG, JPG, PNG')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                // Section 2: Meta Information
                Section::make('Meta Information')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->default(fn() => Auth::id()),
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->required()
                            ->default('draft'),
                        DateTimePicker::make('published_at')
                            ->label('Published At')
                            ->native(false)
                            ->displayFormat('d F Y H:i'),
                        Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->label('Tags'),
                        Toggle::make('is_featured')
                            ->label('Tampilkan di Slider')
                            ->helperText('Aktifkan untuk menampilkan berita ini di slider halaman utama')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }
}
