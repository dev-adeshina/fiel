<?php

namespace App\Domains\Auth\Listeners;

use App\Domains\Auth\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerificationNotification
{
    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $event->user->sendEmailVerificationNotification();
    }
}
