<?php

namespace YottaHQ\LaravelExtendedAuth\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use YottaHQ\LaravelExtendedAuth\Contracts\TwoFactorEnabledResponse as TwoFactorLoginResponseContract;
use Laravel\Fortify\Fortify;

class TwoFactorEnabledResponse implements TwoFactorLoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse(Request $request)
    {
        return $request->wantsJson()
                    ? new JsonResponse('', 200)
                    : back()->with('status', Fortify::TWO_FACTOR_AUTHENTICATION_ENABLED);
    }
}
