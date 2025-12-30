<?php

namespace App\Filament\Resources\Pengaturans;

use App\Filament\Resources\Pengaturans\Pages\CreatePengaturan;
use App\Filament\Resources\Pengaturans\Pages\EditPengaturan;
use App\Filament\Resources\Pengaturans\Pages\ListPengaturans;
use App\Filament\Resources\Pengaturans\Schemas\PengaturanForm;
use App\Filament\Resources\Pengaturans\Tables\PengaturanTable;
use App\Models\Pengaturan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class PengaturanResource extends Resource
{
    protected static ?string $model = Pengaturan::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    public static function canCreate(): bool
    {
        return static::getModel()::count() < 1;
    }

    public static function form(Schema $schema): Schema
    {
        return PengaturanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengaturanTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPengaturans::route('/'),
            'create' => CreatePengaturan::route('/create'),
            'edit' => EditPengaturan::route('/{record}/edit'),
        ];
    }
}
