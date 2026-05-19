<?php

namespace App\Filament\Resources\MenuItems\RelationManagers;

use App\Filament\Resources\MenuItemVariants\MenuItemVariantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    protected static ?string $relatedResource = MenuItemVariantResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
