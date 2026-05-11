<?php 

namespace App\Domains\Auth\DTOs;


class ChangePasswordData 
{
    public function __construct(
                                public string $currentPassword, 
                                public string $newPassword, 
                               
                                ) {}

    public static function fromRequest(mixed $request) : self
    {
        return new self(
            currentPassword: $request->input('current_password'),
            newPassword: $request->input('new_password'),
            
        );
    }
}