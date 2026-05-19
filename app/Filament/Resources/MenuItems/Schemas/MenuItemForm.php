<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                

                Select::make('menu_id')
                    ->relationship('menu', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('menu_category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

               

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->rows(4),

               

                TextInput::make('price')
                    ->numeric()
                    ->prefix('₦')
                    ->required(),

              

                FileUpload::make('image')
                    ->image()
                    ->directory('menu-items'),

              

                Toggle::make('is_available')
                    ->default(true),

                Toggle::make('is_featured')
                    ->default(false),

               

                TextInput::make('preparation_time')
                    ->numeric()
                    ->suffix('mins')
                    ->default(20),

              

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
