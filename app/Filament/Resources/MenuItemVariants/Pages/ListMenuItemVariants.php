<?php

namespace App\Filament\Resources\MenuItemVariants\Pages;

use App\Filament\Resources\MenuItemVariants\MenuItemVariantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuItemVariants extends ListRecords
{
    protected static string $resource = MenuItemVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
