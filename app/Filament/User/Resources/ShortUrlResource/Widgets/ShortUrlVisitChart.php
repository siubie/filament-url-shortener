<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ShortUrlVisitChart extends ChartWidget
{
    protected static ?string $heading = 'Link Visit By Month';

    protected function getData(): array
    {
        $data = Trend::model(ShortURLVisit::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Link Visit Per Month',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
