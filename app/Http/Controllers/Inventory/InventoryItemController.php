<?php

namespace App\Http\Controllers\Inventory;

use App\Domains\Inventory\Models\InventoryItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StoreInventoryItemRequest;
use App\Http\Requests\Inventory\UpdateInventoryItemRequest;
use App\Http\Resources\InventoryItemResource;
use Illuminate\Http\Request;

use App\Domains\Inventory\Actions\AdjustInventoryStockAction;

use App\Http\Requests\Inventory\AdjustInventoryStockRequest;



class InventoryItemController extends Controller
{
    public function index()
    {
        return InventoryItemResource::collection(InventoryItem::latest()->paginate());
    }

    public function store(StoreInventoryItemRequest $request) 
    {

        $item = InventoryItem::create($request->validated());

        return new InventoryItemResource($item);
    }

    public function show(InventoryItem $item) 
    {

        return new InventoryItemResource($item);
    }

    public function update(UpdateInventoryItemRequest $request, InventoryItem $item) 
    {

        $item->update($request->validated());

        return new InventoryItemResource($item->refresh());
    }

    public function destroy(InventoryItem $item) 
    {

        $item->delete();

        return response()->json(['message' => 'Inventory item deleted.',]);
    }

    public function lowStock()
    {
        $items = InventoryItem::query()->whereColumn('stock_quantity', '<=', 'minimum_quantity')
                ->latest()
                ->get();

        return InventoryItemResource::collection($items);
    }

    public function adjustStock(AdjustInventoryStockRequest $request,InventoryItem $item, AdjustInventoryStockAction $action) 
    {

        $inventory = $action->execute(

            item: $item,

            type: $request->type,

            quantity: $request->quantity,

            notes: $request->note,
        );

        return new InventoryItemResource(
            $inventory
        );
    }
}
