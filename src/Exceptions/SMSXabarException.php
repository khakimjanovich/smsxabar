<?php

namespace Khakimjanovich\SMSXabar\Exceptions;

use Exception;
use Illuminate\Http\Client\ConnectionException;

class SMSXabarException extends Exception
{
    public static function connectionException(ConnectionException|Exception $e)
    {
        return new static('ConnectionException: '.$e->getMessage(), 0, $e);
    }
}
