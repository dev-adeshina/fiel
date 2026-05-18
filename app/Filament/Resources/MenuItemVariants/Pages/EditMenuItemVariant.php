<?php

namespace App\Filament\Resources\MenuItemVariants\Pages;

use App\Filament\Resources\MenuItemVariants\MenuItemVariantResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuItemVariant extends EditRecord
{
    protected static string $resource = MenuItemVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
