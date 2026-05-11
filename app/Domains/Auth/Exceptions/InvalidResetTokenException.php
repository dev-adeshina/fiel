<?php 

namespace App\Domains\Auth\Exceptions;

use Exception;

class InvalidResetTokenException extends Exception
{
    public function __construct(string $message = 'Invalid credentials', int $code = 401) {
        parent::__construct($message, $code);
    }
}