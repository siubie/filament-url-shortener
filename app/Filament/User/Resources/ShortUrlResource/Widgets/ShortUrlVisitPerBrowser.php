<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ShortUrlVisitPerBrowser extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Url Visits By Browser',
                    'data' => [100, 200, 300, 400, 500, 600, 700],
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#FF6384'
                    ],
                ],
            ],
            'labels' => [
                'Chrome',
                'Firefox',
                'Safari',
                'Edge',
                'Opera',
                'IE',
                'Other'
            ],

        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
