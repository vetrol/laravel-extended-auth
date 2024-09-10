<?php

namespace YottaHQ\LaravelExtendedAuth\Traits;

use YottaHQ\LaravelExtendedAuth\Models\UserEmailAddress;

trait HasEmailAddresses
{
    /**
     * Get all email addresses for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function emailAddresses()
    {
        return $this->morphMany(config('laravel-extended-auth.user-email-address-model', UserEmailAddress::class), 'emailable');
    }

    /**
     * Get the primary email address for the model.
     * This assumes there's a boolean field 'is_primary' on the email addresses model.
     */
    public function primaryEmailAddress(): mixed
    {
        return $this->emailAddresses()->where('is_primary', true)->first();
    }
}
