<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    public Model $record;
    protected function getStats(): array
    {
        $topOs = DB::table('short_url_visits')
            ->select('operating_system', DB::raw('count(*) as total'))
            ->where('short_url_id', $this->record->id)
            ->groupBy('operating_system')
            ->orderBy('total', 'desc')
            ->first();
        $topBrowser = DB::table('short_url_visits')
            ->select('browser', DB::raw('count(*) as total'))
            ->where('short_url_id', $this->record->id)
            ->groupBy('browser')
            ->orderBy('total', 'desc')
            ->first();
        $topDevice = DB::table('short_url_visits')
            ->select('device_type', DB::raw('count(*) as total'))
            ->where('short_url_id', $this->record->id)
            ->groupBy('device_type')
            ->orderBy('total', 'desc')
            ->first();
        return [
            //
            Stat::make('Unique Clicks', $this->record->visits->count()),
            Stat::make('Top Operating Systems', $topOs?->operating_system),
            Stat::make('Top Browser', $topBrowser?->browser),
            Stat::make('Top Device', $topDevice?->device_type),
        ];
    }
}
