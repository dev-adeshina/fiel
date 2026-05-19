<?php

namespace App\Filament\Resources\MenuItemAvailabilities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class MenuItemAvailabilitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([                
                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('day_of_week')
                    ->searchable(),


                TextColumn::make('start_time')
                    ->searchable(),


                TextColumn::make('end_time')
                    ->searchable(),

                IconColumn::make('is_available')
                    ->boolean(),


            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
