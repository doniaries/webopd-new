<?php

namespace App\Filament\Resources\Dokumens\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DokumenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_dokumen')
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
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                FileUpload::make('cover')
                    ->label('Cover Dokumen')
                    ->image()
                    ->disk('public')
                    ->directory('dokumen/covers')
                    ->visibility('public')
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                    ->maxSize(2048)
                    ->helperText('Upload cover dokumen (max 2MB). Format: JPEG, JPG, PNG'),
                FileUpload::make('file')
                    ->label('File Dokumen')
                    ->disk('public')
                    ->directory('dokumen/files')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->maxSize(2048)
                    ->helperText('Upload file dokumen (max 2MB). Format: PDF, DOC, DOCX, XLS, XLSX')
                    ->required(),
                DatePicker::make('tahun_terbit'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
