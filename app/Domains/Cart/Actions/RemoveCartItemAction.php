<?php

namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\CartItem;

use App\Domains\Cart\Services\CartCalculationService;

class RemoveCartItemAction
{
    public function __construct(
        protected CartCalculationService $calculator
    ) {}

    public function execute(CartItem $item) 
    {

        $cart = $item->cart;

        $item->delete();

        $this->calculator->calculateCart($cart);

        return $cart->fresh(['items.menuItem', 'items.variant', 'items.modifiers',]);
    }
}