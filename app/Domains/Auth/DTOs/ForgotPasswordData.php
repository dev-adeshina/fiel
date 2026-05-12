<?php

namespace App\Domains\Auth\DTOs;

class ForgotPasswordData
{
    public function __construct(
        public string $email,
    ) {}

    public static function fromRequest(mixed $request): self
    {
        return new self(
            email:  $request->input('email'),
        );
    }
}