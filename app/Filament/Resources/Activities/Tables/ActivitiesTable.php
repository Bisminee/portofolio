<?php

namespace App\Filament\Resources\Activities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('priority')
            ->columns([
                TextColumn::make('priority')
                    ->label('#')
                    ->sortable(),
                ImageColumn::make('image_path')
                    ->label('')
                    ->disk('portfolio')
                    ->height(40)
                    ->width(64),
                TextColumn::make('name')
                    ->description(fn ($record) => $record->organization)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'competition' => 'danger',
                        'community' => 'warning',
                        default => 'info',
                    }),
                TextColumn::make('period_en')
                    ->label('Period')
                    ->sortable(false),
                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Live'),
                TextColumn::make('permission_status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'approved_by_owner' ? 'success' : 'warning')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'approved_by_owner' => 'Approved',
                        'pending' => 'Pending',
                        default => 'Declined',
                    }),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make()->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
