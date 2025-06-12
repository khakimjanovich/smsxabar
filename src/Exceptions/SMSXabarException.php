<?php

declare(strict_types=1);

namespace Khakimjanovich\SMSXabar\Exceptions;

use Exception;
use Illuminate\Http\Client\ConnectionException;

final class SMSXabarException extends Exception
{
    public static function connectionException(ConnectionException|Exception $e)
    {
        return new self('ConnectionException: '.$e->getMessage(), 0, $e);
    }
}
