<?php

namespace App\Domains\Auth\DTOs;


class ResetPasswordData 
{
    public function __construct(
                                public string $email, 
                                 public string $password, 
                                  public string $passwordConfirmation, 
                                   public string $token, 
                                ) {}

    public static function fromRequest(mixed $request) : self
    {
        return new self(
            email: $request->input('email'),
            password: $request->input('password'),
            passwordConfirmation: $request->input('password_confirmation'),
            token: $request->input('token'),
        );
    }
}