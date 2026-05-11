<?php

namespace App\Domains\Auth\Listeners;

use App\Domains\Auth\Events\UserRegistered;
use App\Domains\Auth\Notifications\WelcomeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class SendWelcomeEmail
{
    

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        //
        $event->user->notify(new WelcomeNotification());
    }
}
