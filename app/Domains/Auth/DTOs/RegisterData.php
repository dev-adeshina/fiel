<?php

namespace App\Domains\Auth\DTOs;

class RegisterData 
{
    public function __construct(
                                public string $firstName, 
                                public string $lastName, 
                                public string $email, 
                                public string $password
                                ) {}

    public static function fromRequest(mixed $request) : self
    {
        return new self(
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            password: $request->input('password')
        );
    }
}