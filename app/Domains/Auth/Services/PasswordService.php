<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\TokenService;
use Illuminate\Support\Facades\Hash;
use App\Domains\Auth\Exceptions\InvalidCredentialsException;
use App\Domains\Auth\Exceptions\InvalidResetTokenException;
use Illuminate\Support\Facades\Password;

class PasswordService {


    public function __construct(protected TokenService $token){}

   public function changePassword(User $user, string $currentPassword, string $newPassword) 
   {
        $this->validateCurrentPassword(
            $user,
            $currentPassword
        );

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Security Best Practice
        |--------------------------------------------------------------------------
        |
        | Logout user from all devices
        |
        */

        $this->token->revokeAll($user);

        // event(new PasswordChanged($user));
   }


   public function sendResetLink( string $email ): void 
   {

        Password::sendResetLink([
            'email' => $email,
        ]);
    } 


    public function resetPassword(array $credentials) : void
    {
        $status = Password::reset(
            $credentials,

            function (User $user, string $password) {

                $user->update([
                    'password' => Hash::make($password),
                ]);

                /*
                |--------------------------------------------------------------------------
                | Optional Security
                |--------------------------------------------------------------------------
                */

                $this->token->revokeAll($user);

                // event(new PasswordChanged($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {

            throw new InvalidResetTokenException(
                'Invalid or expired reset token.'
            );
        }
    }

    public function validateCurrentPassword( User $user, string $password): void 
    {
        if (! Hash::check( $password, $user->password)) {

            throw new InvalidCredentialsException(
                'Current password is incorrect.'
            );
        }
    }
}