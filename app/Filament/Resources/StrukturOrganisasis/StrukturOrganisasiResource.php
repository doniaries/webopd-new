<?php

namespace App\Filament\Resources\StrukturOrganisasis;

use App\Filament\Resources\StrukturOrganisasis\Pages\CreateStrukturOrganisasi;
use App\Filament\Resources\StrukturOrganisasis\Pages\EditStrukturOrganisasi;
use App\Filament\Resources\StrukturOrganisasis\Pages\ListStrukturOrganisasis;
use App\Filament\Resources\StrukturOrganisasis\Schemas\StrukturOrganisasiForm;
use App\Filament\Resources\StrukturOrganisasis\Tables\StrukturOrganisasiTable;
use App\Models\StrukturOrganisasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class StrukturOrganisasiResource extends Resource
{
    protected static ?string $model = StrukturOrganisasi::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $slug = 'struktur-organisasis';

    protected static ?string $modelLabel = 'Struktur Organisasi';

    protected static ?string $pluralModelLabel = 'Struktur Organisasi';

    protected static ?string $navigationLabel = 'Struktur Organisasi';

    public static function form(Schema $schema): Schema
    {
        return StrukturOrganisasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StrukturOrganisasiTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStrukturOrganisasis::route('/'),
            'create' => CreateStrukturOrganisasi::route('/create'),
            'edit' => EditStrukturOrganisasi::route('/{record}/edit'),
        ];
    }
}
