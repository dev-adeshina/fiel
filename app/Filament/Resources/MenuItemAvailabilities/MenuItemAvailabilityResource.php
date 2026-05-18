<?php

namespace App\Filament\Resources\MenuItemAvailabilities;

use App\Filament\Resources\MenuItemAvailabilities\Pages\CreateMenuItemAvailability;
use App\Filament\Resources\MenuItemAvailabilities\Pages\EditMenuItemAvailability;
use App\Filament\Resources\MenuItemAvailabilities\Pages\ListMenuItemAvailabilities;
use App\Filament\Resources\MenuItemAvailabilities\Schemas\MenuItemAvailabilityForm;
use App\Filament\Resources\MenuItemAvailabilities\Tables\MenuItemAvailabilitiesTable;
use App\Domains\Menu\Models\MenuItemAvailability;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemAvailabilityResource extends Resource
{
    protected static ?string $model = MenuItemAvailability::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Menu';

    protected static ?string $recordTitleAttribute = 'menu_item_availabilities';

    public static function form(Schema $schema): Schema
    {
        return MenuItemAvailabilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuItemAvailabilitiesTable::configure($table);
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
            'index' => ListMenuItemAvailabilities::route('/'),
            'create' => CreateMenuItemAvailability::route('/create'),
            'edit' => EditMenuItemAvailability::route('/{record}/edit'),
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
