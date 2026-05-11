<?php 

namespace App\Domains\Auth\Actions;

use App\Domains\Auth\Services\PasswordService;

class ForgotPasswordAction 
{
    public function __construct(
        protected PasswordService $passwords
    ) {}

    public function execute(
        string $email
    ): void {

        $this->passwords->sendResetLink(
            $email
        );
    }
}