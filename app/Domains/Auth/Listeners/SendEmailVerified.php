<?php

namespace App\Domains\Auth\Listeners;

use App\Domains\Auth\Events\EmailVerified;
use App\Domains\Auth\Notifications\EmailVerifiedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerified
{
    

    /**
     * Handle the event.
     */
    public function handle(EmailVerified $event): void
    {
        $event->user->notify(new EmailVerifiedNotification(restaurantName: config('app.name')));
    }
}
