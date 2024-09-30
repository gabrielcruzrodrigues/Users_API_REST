<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    public function __construct($message = "The user already exists", $code = 409)
    {
        parent::__construct($message, $code);
    }
}
