<?php

namespace App\Domains\Auth\DTOs;

class LoginData 
{
    public function __construct(
                                public string $email, 
                                public string $password
                                ) {}

    public static function fromRequest(mixed $request) : self
    {
        return new self(
            email: $request->input('email'),
            password: $request->input('password')
        );
    }

}