<?php

declare(strict_types=1);

namespace YottaHQ\LaravelExtendedAuth\Exceptions;

use Exception;

class MagicLinkExpiredException extends Exception
{
    protected $message = 'Magic link expired';
}
