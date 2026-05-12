<?php

namespace App\Providers;

use App\Domains\Auth\Events\AccountDeleted;
use App\Domains\Auth\Events\EmailVerified;
use App\Domains\Auth\Events\PasswordChanged;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Domains\Auth\Events\UserRegistered;
use App\Domains\Auth\Listeners\SendAccountDeleted;
use App\Domains\Auth\Listeners\SendEmailVerified;
use App\Domains\Auth\Listeners\SendPasswordChanged;
use App\Domains\Auth\Listeners\SendWelcomeEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Event::listen(UserRegistered::class, SendWelcomeEmail::class);
        Event::listen(AccountDeleted::class, SendAccountDeleted::class);
        Event::listen(PasswordChanged::class, SendPasswordChanged::class);
        Event::listen(EmailVerified::class, SendEmailVerified::class);
    }
}
