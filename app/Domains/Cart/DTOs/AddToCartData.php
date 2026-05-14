<?php 


namespace App\Domains\Cart\DTOs;

use Illuminate\Http\Request;

class AddToCartData
{
    public function __construct(

        public readonly int $menuItemId,

        public readonly ?int $variantId,

        public readonly array $modifierIds,

        public readonly int $quantity,

        public readonly ?string $specialInstructions,
    ) {}

    public static function fromRequest(
        Request $request
    ): self {

        return new self(

            menuItemId:
                $request->integer(
                    'menu_item_id'
                ),

            variantId:
                $request->input(
                    'variant_id'
                ),

            modifierIds:
                $request->input(
                    'modifier_ids',
                    []
                ),

            quantity:
                $request->integer(
                    'quantity',
                    1
                ),

            specialInstructions:
                $request->input(
                    'special_instructions'
                ),
        );
    }
}