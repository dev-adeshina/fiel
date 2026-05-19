<?php

namespace App\Filament\Resources\MenuItems\RelationManagers;

use App\Filament\Resources\MenuItemAvailabilities\MenuItemAvailabilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class AvailabilitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'availabilities';

    protected static ?string $relatedResource = MenuItemAvailabilityResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
