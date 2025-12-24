<?php

namespace App\Filament\Resources\Visits;

use App\Filament\Resources\Visits\Pages\ListVisits;
use App\Filament\Resources\Visits\Tables\VisitTable;
use App\Models\Visit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use UnitEnum;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static string|UnitEnum|null $navigationGroup = 'Analytics';

    public static function table(Table $table): Table
    {
        return VisitTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVisits::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
