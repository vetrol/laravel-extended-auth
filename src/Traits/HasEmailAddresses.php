<?php

namespace YottaHQ\LaravelExtendedAuth\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEmailAddresses
{
    public function emailAddresses(): HasMany
    {
        return $this->hasMany(config('laravel-extended-auth.user-email-address-model'));
    }
}
