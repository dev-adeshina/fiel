<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        then: function () {
            Route::middleware('api')
            ->prefix('api/v1')
            ->group(base_path('routes/api/v1/auth.php'));
            Route::middleware('api')
            ->prefix('api/v1')
            ->group(base_path('routes/api/v1/admin.php'));
            Route::middleware('api')
            ->prefix('api/v1')
            ->group(base_path('routes/api/v1/cart.php'));
            Route::middleware('api')
            ->prefix('api/v1')
            ->group(base_path('routes/api/v1/order.php'));
            Route::middleware('api')
            ->prefix('api/v1')
            ->group(base_path('routes/api/v1/payment.php'));
        }
    )
    
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
            /*
        |--------------------------------------------------------------------------
        | Force JSON Authentication Errors
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            AuthenticationException $e,
            $request
        ) {

            if ($request->is('api/*')) {

                return response()->json([

                    'success' => false,

                    'message' => 'Unauthenticated.',

                ], 401);
            }
        });
    })->create();
