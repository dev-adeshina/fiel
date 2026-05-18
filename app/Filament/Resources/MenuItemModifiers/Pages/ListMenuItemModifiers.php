<?php

namespace App\Filament\Resources\MenuItemModifiers\Pages;

use App\Filament\Resources\MenuItemModifiers\MenuItemModifierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuItemModifiers extends ListRecords
{
    protected static string $resource = MenuItemModifierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
