<?php

namespace App\Filament\Resources\MenuItemModifiers;

use App\Filament\Resources\MenuItemModifiers\Pages\CreateMenuItemModifier;
use App\Filament\Resources\MenuItemModifiers\Pages\EditMenuItemModifier;
use App\Filament\Resources\MenuItemModifiers\Pages\ListMenuItemModifiers;
use App\Filament\Resources\MenuItemModifiers\Schemas\MenuItemModifierForm;
use App\Filament\Resources\MenuItemModifiers\Tables\MenuItemModifiersTable;
use App\Domains\Menu\Models\MenuItemModifier;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemModifierResource extends Resource
{
    protected static ?string $model = MenuItemModifier::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'menu_item_modifiers';

    public static function form(Schema $schema): Schema
    {
        return MenuItemModifierForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuItemModifiersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenuItemModifiers::route('/'),
            'create' => CreateMenuItemModifier::route('/create'),
            'edit' => EditMenuItemModifier::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
