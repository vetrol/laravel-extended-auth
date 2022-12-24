<?php

namespace YottaHQ\LaravelExtendedAuth\Events;

use Illuminate\Queue\SerializesModels;

class UserEmailAddressVerified
{
    use SerializesModels;

    /**
     * The verified user email address.
     *
     * @var \Illuminate\Contracts\Auth\MustVerifyEmail
     */
    public $emailAddress;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\MustVerifyEmail  $emailAddress
     * @return void
     */
    public function __construct($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
}
