<?php 

namespace App\Domains\Auth\DTOs;


class ResendEmailVerificationData 
{
    public function __construct(){}

    public static function fromRequest(mixed $request) : self
    {
        return new self();
    }
}