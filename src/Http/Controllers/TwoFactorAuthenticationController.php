<?php

namespace YottaHQ\LaravelExtendedAuth\Http\Controllers;

use Illuminate\Http\Request;
use YottaHQ\LaravelExtendedAuth\Actions\DisableTwoFactorAuthentication;
use YottaHQ\LaravelExtendedAuth\Actions\EnableTwoFactorAuthentication;
use YottaHQ\LaravelExtendedAuth\Contracts\TwoFactorDisabledResponse;
use YottaHQ\LaravelExtendedAuth\Contracts\TwoFactorEnabledResponse;

class TwoFactorAuthenticationController
{
    /**
     * @throws \JsonException
     */
    public function store(Request $request, EnableTwoFactorAuthentication $enable)
    {
        $enable($request->user(), $request->get('device_name'));

        return app(TwoFactorEnabledResponse::class);
    }

    public function destroy(Request $request, DisableTwoFactorAuthentication $disable)
    {
        $disable($request->user());

        return app(TwoFactorDisabledResponse::class);
    }
}
