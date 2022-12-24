<?php

namespace YottaHQ\LaravelExtendedAuth;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use YottaHQ\LaravelExtendedAuth\Events\UserEmailAddressAdded;
use YottaHQ\LaravelExtendedAuth\Listeners\SendEmailVerificationNotification;

class LaravelExtendedAuthEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserEmailAddressAdded::class => [
            SendEmailVerificationNotification::class,
        ],
    ];
}
