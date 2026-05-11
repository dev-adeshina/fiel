<?php

namespace App\Domains\Auth\Actions;

use App\Domains\Auth\Services\PasswordService;
use App\Domains\Auth\DTOs\ResetPasswordData;

class ResetPasswordAction
{
    public function __construct(
        protected PasswordService $passwords
    ) {}

    public function execute(
        ResetPasswordData $data
    ): void {

        $this->passwords->resetPassword([
            'email' => $data->email,
            'password' => $data->password,
            'password_confirmation' => $data->passwordConfirmation,
            'token' => $data->token,
        ]);
    }
}