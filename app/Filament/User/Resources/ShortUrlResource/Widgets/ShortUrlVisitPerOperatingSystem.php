<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class ShortUrlVisitPerOperatingSystem extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    public $record;
    protected function getData(): array
    {
        //select browser and agregate on ShortURLVisit table
        $data = ShortURLVisit::select('operating_system', DB::raw('count(*) as total'))
            ->where('short_url_id', $this->record->id)
            ->groupBy('operating_system')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Link Visit Per Operating System',
                    'data' => $data->map(fn ($value) => $value->total),
                ],
            ],
            'labels' => $data->map(fn ($value) => $value->operating_system),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
