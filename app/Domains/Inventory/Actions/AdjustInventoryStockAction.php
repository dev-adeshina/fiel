<?php

namespace App\Domains\Inventory\Actions;

use Illuminate\Support\Facades\DB;

use App\Domains\Inventory\Models\InventoryItem;

use App\Domains\Inventory\Models\InventoryMovement;

class AdjustInventoryStockAction
{
    public function execute(InventoryItem $item, string $type, float $quantity, ?string $reference = null, ?string $notes = null,): InventoryItem 
    {

        return DB::transaction(function () use ($item, $type, $quantity, $reference, $notes) 
        {

            /*
            |--------------------------------------------------------------------------
            | Create movement record
            |--------------------------------------------------------------------------
            */

            InventoryMovement::create([
                'inventory_item_id' => $item->id,
                'type' => $type,
                'quantity' => $quantity,
                'reference' => $reference,
                'notes' => $notes,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Adjust stock
            |--------------------------------------------------------------------------
            */

            match ($type) {

                'stock_in' => $item->increment('quantity', $quantity),
                'stock_out',
                'waste' => $item->decrement('quantity', $quantity),
                'adjustment' => $item->update(['quantity' => $quantity,]),
                default => null,
            };

            return $item->refresh();
        });
    }
}
