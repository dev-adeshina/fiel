<?php

namespace App\Filament\Resources\MenuItems\RelationManagers;

use App\Filament\Resources\MenuItemModifiers\MenuItemModifierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ModifiersRelationManager extends RelationManager
{
    protected static string $relationship = 'modifiers';

    protected static ?string $relatedResource = MenuItemModifierResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
