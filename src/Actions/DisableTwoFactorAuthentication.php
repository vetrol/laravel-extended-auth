<?php

namespace YottaHQ\LaravelExtendedAuth\Actions;

use YottaHQ\LaravelExtendedAuth\Events\TwoFactorAuthenticationDisabled;

class DisableTwoFactorAuthentication
{
    public function __invoke($user)
    {
        $user->twoFactorDevices()->delete();
        TwoFactorAuthenticationDisabled::dispatch($user);
    }
}
