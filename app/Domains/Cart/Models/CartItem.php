<?php

namespace App\Domains\Cart\Models;

use App\Domains\Menu\Models\MenuItem;
use App\Domains\Menu\Models\MenuItemModifier;
use App\Domains\Menu\Models\MenuItemVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class CartItem extends Model
{

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function menuItem() : BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(MenuItemVariant::class, 'menu_item_variant_id');
    }

    public function modifiers() : BelongsToMany
    {
        return $this->belongsToMany(MenuItemModifier::class, 'cart_item_modifier');
    }
    
   
}
