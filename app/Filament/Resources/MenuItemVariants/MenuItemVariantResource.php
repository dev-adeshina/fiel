<?php

namespace App\Filament\Resources\MenuItemVariants;

use App\Filament\Resources\MenuItemVariants\Pages\CreateMenuItemVariant;
use App\Filament\Resources\MenuItemVariants\Pages\EditMenuItemVariant;
use App\Filament\Resources\MenuItemVariants\Pages\ListMenuItemVariants;
use App\Filament\Resources\MenuItemVariants\Schemas\MenuItemVariantForm;
use App\Filament\Resources\MenuItemVariants\Tables\MenuItemVariantsTable;
use App\Domains\Menu\Models\MenuItemVariant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemVariantResource extends Resource
{
    protected static ?string $model = MenuItemVariant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Menu';

    protected static ?string $recordTitleAttribute = 'menu_item_variants';

    public static function form(Schema $schema): Schema
    {
        return MenuItemVariantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuItemVariantsTable::configure($table);
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
            'index' => ListMenuItemVariants::route('/'),
            'create' => CreateMenuItemVariant::route('/create'),
            'edit' => EditMenuItemVariant::route('/{record}/edit'),
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
