<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('case_no')
                    ->label('No.')
                    ->sortable(),
                TextColumn::make('title')
                    ->description(fn ($record) => $record->subtitle)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ownership')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Team project' => 'danger',
                        'Coursework' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('year')
                    ->sortable(),
                IconColumn::make('featured')
                    ->boolean()
                    ->label('Featured'),
                IconColumn::make('published')
                    ->boolean()
                    ->label('Live'),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('ownership')
                    ->options([
                        'Team project' => 'Team project',
                        'Coursework' => 'Coursework',
                        'Personal project' => 'Personal project',
                    ]),
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
