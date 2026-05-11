<?php 

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\EmailVerified;
use App\Domains\Auth\Models\User;



class EmailVerificationService {


    public function verify(User $user) : void
    {   
        if($user->hasVerifiedEmail())
        {
            return;
        }

        $user->markEmailAsUnverified();

        event(new EmailVerified($user));
    }

    public function resend(User $user) : void
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->sendEmailVerificationNotification();
    }


    
}