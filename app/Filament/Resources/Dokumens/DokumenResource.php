<?php

namespace App\Filament\Resources\Dokumens;

use App\Filament\Resources\Dokumens\Pages\CreateDokumen;
use App\Filament\Resources\Dokumens\Pages\EditDokumen;
use App\Filament\Resources\Dokumens\Pages\ListDokumens;
use App\Filament\Resources\Dokumens\Schemas\DokumenForm;
use App\Filament\Resources\Dokumens\Tables\DokumenTable;
use App\Models\Dokumen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class DokumenResource extends Resource
{
    protected static ?string $model = Dokumen::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document';

    protected static string|UnitEnum|null $navigationGroup = 'Site Content';

    public static function form(Schema $schema): Schema
    {
        return DokumenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DokumenTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDokumens::route('/'),
            'create' => CreateDokumen::route('/create'),
            'edit' => EditDokumen::route('/{record}/edit'),
        ];
    }
}
