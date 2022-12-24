<?php

namespace YottaHQ\LaravelExtendedAuth\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use YottaHQ\LaravelExtendedAuth\Models\UserEmailAddress;

class UserEmailAddressRemoved
{
    use Dispatchable, SerializesModels;

    public function __construct(public UserEmailAddress $userEmailAddress)
    {
    }
}
