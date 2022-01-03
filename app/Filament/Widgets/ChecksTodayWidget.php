<?php

namespace App\Filament\Widgets;

use App\Models\Check;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\Widget;

class ChecksTodayWidget extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Number of Checks (today)', Check::query()->whereDate('created_at', today())->count()),
        ];
    }
}
