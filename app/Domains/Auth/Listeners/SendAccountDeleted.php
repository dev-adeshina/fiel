<?php

namespace App\Domains\Auth\Listeners;

use App\Domains\Auth\Events\AccountDeleted;
use App\Domains\Auth\Notifications\AccountDeletionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAccountDeleted
{
    

    /**
     * Handle the event.
     */
    public function handle(AccountDeleted $event): void
    {
        $event->user->notify(new AccountDeletionNotification(restaurantName: config('app.name')));
    }
}
