<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')
                    ->image()
                    ->directory('menus'),

                Textarea::make('description')
                    ->rows(4),

                

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
