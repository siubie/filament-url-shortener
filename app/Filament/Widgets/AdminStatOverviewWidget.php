<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class AdminStatOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        //count total user
        $totalUser = DB::table('users')->count();
        //count total links created
        $totalLinks = DB::table('short_urls')->count();
        //count total visit
        $totalVisit = DB::table('short_url_visits')->count();
        return [
            Stat::make('Unique User', $totalUser),
            Stat::make('Total Links', $totalLinks),
            Stat::make('Total Visit', $totalVisit),
        ];
    }
}
