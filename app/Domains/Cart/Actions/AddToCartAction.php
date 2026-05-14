<?php

namespace App\Domains\Cart\Actions;

use Illuminate\Support\Str;

use App\Domains\Cart\Models\Cart;
use App\Domains\Cart\Models\CartItem;

use App\Domains\Menu\Models\MenuItem;

use App\Domains\Cart\DTOs\AddToCartData;

use App\Domains\Cart\Services\CartCalculationService;

use App\Domains\Menu\Services\MenuAvailabilityService;

class AddToCartAction
{
    public function __construct(

        protected CartCalculationService $calculator,

        protected MenuAvailabilityService $availability,
    ) {}

    public function execute(AddToCartData $data): Cart 
    {

        /*
        |--------------------------------------------------------------------------
        | Find Menu Item
        |--------------------------------------------------------------------------
        */

        $menuItem = MenuItem::query()

            ->with([
                'variants',
                'modifiers',
            ])

            ->findOrFail(
                $data->menuItemId
            );

        /*
        |--------------------------------------------------------------------------
        | Validate Availability
        |--------------------------------------------------------------------------
        */

        if (! $this->availability->isAvailableNow($menuItem)) 
        {

            abort(422, 'Menu item is unavailable.');
        }

        /*
        |--------------------------------------------------------------------------
        | Find/Create Cart
        |--------------------------------------------------------------------------
        */

        $cart = Cart::query()->firstOrCreate(
                ['user_id' => auth()->id(),],
                ['uuid' => Str::uuid(), 'expires_at' => now()->addDays(7),]
            );

        /*
        |--------------------------------------------------------------------------
        | Create Cart Item
        |--------------------------------------------------------------------------
        */

        $cartItem = CartItem::create([

            'uuid' => Str::uuid(),

            'cart_id' => $cart->id,

            'menu_item_id'
                => $menuItem->id,

            'menu_item_variant_id'
                => $data->variantId,

            'quantity'
                => $data->quantity,

            'unit_price' => 0,

            'total_price' => 0,

            'special_instructions'
                => $data->specialInstructions,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Attach Modifiers
        |--------------------------------------------------------------------------
        */

        $cartItem->modifiers()->sync(
            $data->modifierIds
        );

        /*
        |--------------------------------------------------------------------------
        | Recalculate Cart
        |--------------------------------------------------------------------------
        */

        $this->calculator
            ->calculateCart($cart);

        return $cart->fresh([
            'items.menuItem',
            'items.variant',
            'items.modifiers',
        ]);
    }
}