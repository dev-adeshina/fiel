<?php

namespace App\Filament\Resources\MenuItemModifiers\Pages;

use App\Filament\Resources\MenuItemModifiers\MenuItemModifierResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuItemModifier extends EditRecord
{
    protected static string $resource = MenuItemModifierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
