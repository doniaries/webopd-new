<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ContentChartWidget extends ChartWidget
{
    protected ?string $heading = 'Content Chart Widget';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
