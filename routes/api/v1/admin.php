<?php

use App\Http\Controllers\Inventory\InventoryItemController;
use App\Http\Controllers\Inventory\InventoryMovementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\Menu\MenuItemModifierController;
use App\Http\Controllers\Menu\MenuItemVariantController;
use App\Http\Controllers\Menu\MenuCategoryController;
use App\Http\Controllers\Order\KitchenController;
use App\Http\Controllers\Order\KitchenMetricsController;
use App\Http\Controllers\Order\OrderStatusController;
use App\Http\Controllers\Reservation\AdminReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SalesReportController;
use App\Http\Controllers\Admin\AnalyticsController;


Route::prefix('admin')->group(function () {
    
    Route::middleware(['auth:sanctum', 'verified', 'role:admin|manager',])->group(function () {

        Route::prefix('menus')->group(function () {
            Route::post('/', [MenuController::class, 'store']);
            Route::patch('/{menu}', [MenuController::class, 'update'])->middleware('auth:sanctum');
            Route::delete('/{menu}', [MenuController::class, 'destroy']);
        });

        Route::prefix('menu-items')->group(function () {
            Route::post('/', [MenuItemController::class, 'store']);
            Route::patch('/{menuItem}', [MenuItemController::class, 'update']);
            Route::delete('/{menuItem}',[MenuItemController::class, 'destroy']);
        });

        Route::prefix('menu-item-variants')->group(function () {
            Route::post('/', [MenuItemVariantController::class, 'store']);
            Route::patch('/{variant}', [MenuItemVariantController::class, 'update']);
            Route::delete('/{variant}', [MenuItemVariantController::class, 'destroy']);
        });

        Route::prefix('menu-item-modifiers')->group(function () {
            Route::post('/', [MenuItemModifierController::class, 'store']);
            Route::patch('/{modifier}',[MenuItemModifierController::class, 'update']);
            Route::delete('/{modifier}', [MenuItemModifierController::class, 'destroy']);
        });

        Route::prefix('menu-categories')->group(function () {

            Route::post('/', [MenuCategoryController::class, 'store']);

            Route::patch('/{category}', [MenuCategoryController::class, 'update']);

            Route::delete('/{category}', [MenuCategoryController::class, 'destroy']);
        });

        Route::prefix('orders')->group(function () {

            Route::patch('/{order}/status', [OrderStatusController::class, 'update']);

        });

        Route::middleware('kitchen-staff')->prefix('kitchen')->group(function () {
            Route::get('/', [KitchenController::class, 'index']);
            Route::get('/metrics', KitchenMetricsController::class);
        });

        Route::prefix('inventory')->group(function () {
            Route::get('/items', [InventoryItemController::class, 'index']);

            Route::post('/items', [InventoryItemController::class, 'store']);

            Route::get('/items/low-stock', [InventoryItemController::class, 'lowStock']);

            Route::get('/items/{item}', [InventoryItemController::class, 'show']);

            Route::patch('/items/{item}', [InventoryItemController::class, 'update']);

            Route::delete('/items/{item}', [InventoryItemController::class, 'destroy']);

            Route::post('/items/{item}/adjust-stock', [InventoryItemController::class, 'adjustStock']);

            Route::get('/movements', [InventoryMovementController::class, 'index']);
        });

        Route::prefix('reservations')->group(function() {
            Route::get('/', [AdminReservationController::class, 'index']);
            Route::patch('/{reservation}/status', [AdminReservationController::class, 'updateStatus']);
        });   
        
        Route::prefix('home')->group(function() {
            Route::get('/dashboard', DashboardController::class);

            Route::get('/reports/sales', SalesReportController::class);

            Route::get('/reports/top-selling-items', [AnalyticsController::class, 'topSellingItems']);

            Route::get('/reports/low-stock-items', [AnalyticsController::class, 'lowStockItems']);
        });
    });

});
