<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\Menu\MenuItemModifierController;
use App\Http\Controllers\Menu\MenuItemVariantController;
use App\Http\Controllers\Menu\MenuCategoryController;


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
               
    });

});
