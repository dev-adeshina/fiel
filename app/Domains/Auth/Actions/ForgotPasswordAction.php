<?php 

namespace App\Domains\Auth\Actions;

use App\Domains\Auth\DTOs\ForgotPasswordData;
use App\Domains\Auth\Services\PasswordService;


class ForgotPasswordAction 
{
    public function __construct(
        protected PasswordService $passwords
    ) {}

    public function execute(ForgotPasswordData $data): void 
    {

        $this->passwords->sendResetLink(
            $data->email
        );
    }
}