<?php 

namespace App\Domains\Auth\Actions;


use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\PasswordService;
use App\Domains\Auth\DTOs\ChangePasswordData;

class ChangePasswordAction 
{
    public function __construct(
        protected PasswordService $passwords
    ) {}

    public function execute(
        User $user,
        ChangePasswordData $data
    ): void {

        $this->passwords->changePassword(
            $user,
            $data->currentPassword,
            $data->newPassword
        );
    }
}