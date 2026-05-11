<?php 

namespace App\Domains\Auth\Actions;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\EmailVerificationService;



class VerifyEmailAction 
{
    public function __construct(protected EmailVerificationService $emails){}

    public function execute(User $user) : void
    {
        $this->emails->verify($user);
    }
}