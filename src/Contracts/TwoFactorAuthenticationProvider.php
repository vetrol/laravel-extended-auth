<?php

namespace YottaHQ\LaravelExtendedAuth\Contracts;

interface TwoFactorAuthenticationProvider
{
    /**
     * Generate a new secret key.
     */
    public function generateSecretKey(): string;

    /**
     * Get the two factor authentication QR code URL.
     */
    public function qrCodeUrl($appName, $appEmail, $secret): string;

    /**
     * Verify the given token.
     */
    public function verify($secret, $code): bool;
}
