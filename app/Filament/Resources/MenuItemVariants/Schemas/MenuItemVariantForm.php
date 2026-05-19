<?php

namespace App\Filament\Resources\MenuItemVariants\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class MenuItemVariantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                

                Select::make('menu_item_id')
                    ->relationship('menuItem', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

               

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

               

                TextInput::make('price')
                    ->numeric()
                    ->prefix('₦')
                    ->required(),

                

                TextInput::make('sku')
                    ->maxLength(255),

                

                Toggle::make('is_available')
                    ->default(true),


                Toggle::make('is_default')
                    ->default(false),


                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
