<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckResource\Pages;
use App\Filament\Resources\CheckResource\Pages\ListChecks;
use App\Filament\Resources\CheckResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\ChecksRelationManager;
use App\Models\Check;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\LinkAction;
use Illuminate\Support\HtmlString;

class CheckResource extends Resource
{
    protected static ?string $model = Check::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site.name')
                    ->url(fn ($record) => SiteResource::getUrl('edit', ['record' => $record->site]))
                    ->hidden(fn ($livewire) => $livewire instanceof ChecksRelationManager),
                Tables\Columns\BadgeColumn::make('status')
                    ->enum([
                        'in_progress' => 'In progress',
                        'complete' => 'Complete',
                        'failed' => 'Failed',
                    ])
                    ->colors([
                        'danger' => 'failed',
                        'warning' => 'in_progress',
                        'success' => 'complete',
                    ]),
                Tables\Columns\TextColumn::make('finished_at')
                    ->label('Finished')
                    ->dateTime(),
            ])
            ->prependActions([
                LinkAction::make('View')
                    ->hidden(fn ($livewire) => $livewire instanceof ListChecks)
                    ->url(fn ($record) => static::getUrl('view', ['record' => $record])),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChecks::route('/'),
            'view' => Pages\ViewCheck::route('/{record}'),
        ];
    }
}
