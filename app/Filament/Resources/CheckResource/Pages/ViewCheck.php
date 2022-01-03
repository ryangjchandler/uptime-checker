<?php

namespace App\Filament\Resources\CheckResource\Pages;

use App\Filament\Resources\CheckResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCheck extends ViewRecord
{
    protected static string $resource = CheckResource::class;

    protected static ?string $title = 'View Check';

    protected static string $view = 'filament.resources.check-resource.pages.view-check';
}
