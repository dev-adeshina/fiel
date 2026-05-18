<?php

namespace App\Filament\Resources\MenuItemAvailabilities\Pages;

use App\Filament\Resources\MenuItemAvailabilities\MenuItemAvailabilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuItemAvailabilities extends ListRecords
{
    protected static string $resource = MenuItemAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
