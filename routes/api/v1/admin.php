<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Menu\MenuItemController;


Route::prefix('admin')->group(function () {
    
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {

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

    });

});
