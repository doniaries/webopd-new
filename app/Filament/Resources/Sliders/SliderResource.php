<?php

namespace App\Filament\Resources\Sliders;

use App\Filament\Resources\Sliders\Pages\CreateSlider;
use App\Filament\Resources\Sliders\Pages\EditSlider;
use App\Filament\Resources\Sliders\Pages\ListSliders;
use App\Filament\Resources\Sliders\Schemas\SliderForm;
use App\Filament\Resources\Sliders\Tables\SliderTable;
use App\Models\Slider;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    public static function form(Schema $schema): Schema
    {
        return SliderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SliderTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSliders::route('/'),
            'create' => CreateSlider::route('/create'),
            'edit' => EditSlider::route('/{record}/edit'),
        ];
    }
}
