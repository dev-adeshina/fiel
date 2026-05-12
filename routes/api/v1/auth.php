<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\DeleteAccountController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\ResendEmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
// use App\Http\Controllers\Auth\UserController;

Route::prefix('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    Route::post('/register', RegisterController::class);

    Route::post('/login', LoginController::class);

    /*
    |--------------------------------------------------------------------------
    | Password Reset
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/forgot-password',
        ForgotPasswordController::class
    )->middleware('throttle:3,1');

    Route::post(
        '/reset-password',
        ResetPasswordController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->middleware(['auth:sanctum','signed'])->name('verification.verify');
    
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

        Route::get('/me', MeController::class);

        Route::post('/logout', LogoutController::class)->middleware('throttle:5,1');

        /*
        |--------------------------------------------------------------------------
        | Password Management
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/change-password',
            ChangePasswordController::class
        );

        /*
        |--------------------------------------------------------------------------
        | Email Verification
        |--------------------------------------------------------------------------
        */


        Route::post(
            '/email/resend',
            ResendEmailVerificationController::class
        );

        /*
        |--------------------------------------------------------------------------
        | Account Management
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/account',
            DeleteAccountController::class
        );

    });

});
