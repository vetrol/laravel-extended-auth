<?php

namespace YottaHQ\LaravelExtendedAuth;

class LaravelExtendedAuth
{
    public static bool $runsMigrations = true;

    public static bool $registersRoutes = true;

    public static bool $registersServiceProviders = true;

    public static function ignoreRoutes(): static
    {
        static::$registersRoutes = false;

        return new static;
    }

    public static function ignoreMigrations(): static
    {
        static::$runsMigrations = false;

        return new static;
    }

    public static function ignoreServiceProvider(): static
    {
        static::$registersServiceProviders = false;

        return new static;
    }
}
