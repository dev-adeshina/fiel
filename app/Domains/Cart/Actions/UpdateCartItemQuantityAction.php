<?php

namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\CartItem;

use App\Domains\Cart\Services\CartCalculationService;

class UpdateCartItemQuantityAction
{
    public function __construct(
        protected CartCalculationService $calculator
    ) {}

    public function execute(CartItem $item, int $quantity) 
    {

        $item->update(['quantity' => $quantity,]);

        $this->calculator->calculateCart($item->cart);

        return $item->cart->fresh(['items.menuItem','items.variant','items.modifiers',]);
    }
}