<?php

namespace App\Filament\Resources\MenuItemAvailabilities\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;

class MenuItemAvailabilityForm
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

               

                 Textarea::make('description')
                    ->rows(4),

               

                TimePicker::make('start_time'),
                TimePicker::make('end_time'),
              

                Toggle::make('is_available')
                    ->default(true),

               

            ]);
    }
}
