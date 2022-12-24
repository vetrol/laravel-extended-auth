<?php

namespace YottaHQ\LaravelExtendedAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \YottaHQ\LaravelExtendedAuth\LaravelExtendedAuth
 */
class ExtendedAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \YottaHQ\LaravelExtendedAuth\LaravelExtendedAuth::class;
    }
}
