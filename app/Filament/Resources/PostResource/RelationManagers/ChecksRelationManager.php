<?php

namespace App\Filament\Resources\PostResource\RelationManagers;

use App\Filament\Resources\CheckResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ChecksRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'checks';

    protected static ?string $recordTitleAttribute = 'site.name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return CheckResource::table($table);
    }
}
