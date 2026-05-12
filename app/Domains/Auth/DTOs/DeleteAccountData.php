<?php 

namespace App\Domains\Auth\DTOs;

class DeleteAccountData 
{
    public function __construct(public string $password,
        public ?string $confirmation = null,){}

    public static function fromRequest(mixed $request) : self
    {
        return new self(
            password: $request->input('password'),

            confirmation: $request->input('confirmation'),
        );
    }
}