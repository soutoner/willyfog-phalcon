<?php

namespace App\Exceptions;

class OAuthException extends Exception
{
    public function __construct($message = 'Access token not provided', $code = 401)
    {
        parent::__construct($message, $code);
    }
}
