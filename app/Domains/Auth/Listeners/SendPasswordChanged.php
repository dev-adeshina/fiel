<?php

namespace App\Domains\Auth\Listeners;

use App\Domains\Auth\Events\PasswordChanged;
use App\Domains\Auth\Notifications\ChangeOfPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordChanged
{
    
    /**
     * Handle the event.
     */
    public function handle(PasswordChanged $event): void
    {
        $event->user->notify(new ChangeOfPasswordNotification(restaurantName: config('app.name')));
    }
}
