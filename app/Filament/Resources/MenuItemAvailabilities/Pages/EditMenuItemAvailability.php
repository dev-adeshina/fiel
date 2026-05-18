<?php

namespace App\Filament\Resources\MenuItemAvailabilities\Pages;

use App\Filament\Resources\MenuItemAvailabilities\MenuItemAvailabilityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuItemAvailability extends EditRecord
{
    protected static string $resource = MenuItemAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
