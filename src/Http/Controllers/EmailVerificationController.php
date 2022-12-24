<?php

namespace YottaHQ\LaravelExtendedAuth\Http\Controllers;

use App\Providers\RouteServiceProvider;
use YottaHQ\LaravelExtendedAuth\Events\UserEmailAddressVerified;
use YottaHQ\LaravelExtendedAuth\Exceptions\InvalidOperationException;
use YottaHQ\LaravelExtendedAuth\Models\UserEmailAddress;

class EmailVerificationController
{
    /**
     * @throws InvalidOperationException
     */
    public function verify()
    {
        $emailAddress = UserEmailAddress::where('id', request()->route('id'))->first();

        if (
            !$emailAddress ||
            !hash_equals((string) request()->route('id'), (string) $emailAddress->getKey())
        ) {
            throw new InvalidOperationException('Email not found');
        }

        if (!hash_equals((string) request()->route('hash'), sha1($emailAddress->email))) {
            throw new InvalidOperationException('Invalid request');
        }

        if ($emailAddress->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($emailAddress->markEmailAsVerified()) {
            event(new UserEmailAddressVerified($emailAddress));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
