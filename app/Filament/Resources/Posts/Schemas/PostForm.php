<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
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
            ->columns(3)
            ->components([
                Group::make()
                    ->columnSpan(2)
                    ->schema([
                        Section::make('Detail Berita')
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
                                    ->hidden()
                                    ->dehydrated(),
                                RichEditor::make('content')
                                    ->label('Konten Berita')
                                    ->required()
                                    ->textColors([
                                        '#ef4444' => 'Red',
                                        '#10b981' => 'Green',
                                        '#0ea5e9' => 'Sky',
                                    ])
                                    ->toolbarButtons([
                                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                        ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                        ['table', 'attachFiles'], // The `customBlocks` and `mergeTags` tools are also added here if those features are used.
                                        ['undo', 'redo'],
                                    ])
                                    ->placeholder('Tulis konten berita di sini...')
                                    ->columnSpanFull(),
                                FileUpload::make('foto_utama')
                                    ->label('Foto Utama')
                                    ->image()
                                    ->required()
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
                                FileUpload::make('gallery')
                                    ->label('Foto Galeri')
                                    ->multiple()
                                    ->image()
                                    ->disk('public')
                                    ->directory('posts/galleries')
                                    ->visibility('public')
                                    ->imageEditor()
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->appendFiles()
                                    ->maxSize(2048)
                                    ->helperText('Upload foto galeri (max 2MB/foto). Bisa upload banyak sekaligus.'),
                            ])
                            ->columns(1),
                    ]),

                Group::make()
                    ->columnSpan(1)
                    ->schema([
                        Section::make('Informasi Tambahan')
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
                                    ->default('draft')
                                    ->visible(fn() => !auth()->user()->hasRole('contributor')),
                                DateTimePicker::make('published_at')
                                    ->label('Published At')
                                    ->default(now())
                                    ->native(false)
                                    ->displayFormat('d F Y H:i'),
                                Select::make('tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->required()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->unique('tags', 'name', ignoreRecord: true)
                                            ->label('Nama Tag/Kategori')
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique('tags', 'slug', ignoreRecord: true)
                                            ->hidden()
                                            ->dehydrated(),
                                    ])
                                    ->label('Tags/Kategori'),
                                Toggle::make('is_featured')
                                    ->label('Tampilkan di Slider')
                                    ->helperText('Aktifkan untuk menampilkan berita ini di slider halaman utama')
                                    ->default(false),
                            ])
                    ]),
            ]);
    }
}
