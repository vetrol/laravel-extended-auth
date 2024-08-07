<?php

namespace YottaHQ\LaravelExtendedAuth;

class LaravelExtendedAuth
{
    public static bool $runsMigrations = true;

    public static bool $registersRoutes = true;

    public static bool $registersServiceProviders = true;

    public const RECOVERY_CODES_GENERATED = 'recovery-codes-generated';
    public const TWO_FACTOR_AUTHENTICATION_CONFIRMED = 'two-factor-authentication-confirmed';
    public const TWO_FACTOR_AUTHENTICATION_DISABLED = 'two-factor-authentication-disabled';
    public const TWO_FACTOR_AUTHENTICATION_ENABLED = 'two-factor-authentication-enabled';

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
