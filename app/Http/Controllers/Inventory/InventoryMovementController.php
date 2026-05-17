<?php

namespace App\Http\Controllers\Inventory;

use App\Domains\Inventory\Models\InventoryMovement;
use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryMovementResource;
use Illuminate\Http\Request;



class InventoryMovementController extends Controller
{
    public function index()
    {
        return InventoryMovementResource::collection(

            InventoryMovement::latest()

                ->paginate()
        );
    }
}
