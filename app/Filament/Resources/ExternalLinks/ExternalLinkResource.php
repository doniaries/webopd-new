<?php

namespace App\Filament\Resources\ExternalLinks;

use App\Filament\Resources\ExternalLinks\Pages\CreateExternalLink;
use App\Filament\Resources\ExternalLinks\Pages\EditExternalLink;
use App\Filament\Resources\ExternalLinks\Pages\ListExternalLinks;
use App\Filament\Resources\ExternalLinks\Schemas\ExternalLinkForm;
use App\Filament\Resources\ExternalLinks\Tables\ExternalLinkTable;
use App\Models\ExternalLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class ExternalLinkResource extends Resource
{
    protected static ?string $model = ExternalLink::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-link';

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    public static function form(Schema $schema): Schema
    {
        return ExternalLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExternalLinkTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExternalLinks::route('/'),
            'create' => CreateExternalLink::route('/create'),
            'edit' => EditExternalLink::route('/{record}/edit'),
        ];
    }
}
