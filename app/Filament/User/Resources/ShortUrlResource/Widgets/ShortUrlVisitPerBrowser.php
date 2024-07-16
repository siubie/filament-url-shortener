<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class ShortUrlVisitPerBrowser extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        //get unique browser from ShortURLVisit table and the count of visit according to the browser
        $data = ShortURLVisit::select('browser', DB::raw('count(*) as total'))
            ->groupBy('browser')
            ->get();
        return [
            'datasets' => [
                [
                    'label' => 'Url Visits By Browser',
                    // convert $data to data array
                    'data' => $data->map(fn ($value) => $value->total)->toArray(),
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
            //convert $data to labels array
            'labels' => $data->map(fn ($value) => $value->browser)->toArray(),

        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
