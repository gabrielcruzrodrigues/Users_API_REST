<?php

namespace App\Exceptions;

use Exception;

class DatabaseExeption extends Exception
{
    public function __construct($message = "A database error occurred", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
