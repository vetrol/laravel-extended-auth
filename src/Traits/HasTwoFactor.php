<?php

namespace YottaHQ\LaravelExtendedAuth\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTwoFactor
{
    public function twoFactorDevices(): HasMany
    {
        return $this->hasMany(config('laravel-extended-auth.two-factor-device-model'));
    }

    public function getHasTwoFactorAttribute(): bool
    {
        return $this->twoFactorDevices()->count() > 0;
    }
}
