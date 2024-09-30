<?php

namespace App\Exceptions;

use Exception;

class UserNotFound extends Exception
{
    public function __construct($message = "User not found.", $code = 409)
    {
        parent::__construct($message, $code);
    }
}
