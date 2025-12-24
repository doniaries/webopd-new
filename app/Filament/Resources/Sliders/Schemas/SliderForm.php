<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('post_id')
                    ->relationship('post', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
