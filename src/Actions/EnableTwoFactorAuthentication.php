<?php

namespace YottaHQ\LaravelExtendedAuth\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use YottaHQ\LaravelExtendedAuth\Contracts\TwoFactorAuthenticationProvider;
use YottaHQ\LaravelExtendedAuth\Events\TwoFactorAuthenticationEnabled;

class EnableTwoFactorAuthentication
{
    public function __construct(protected TwoFactorAuthenticationProvider $provider)
    {
    }

    public function __invoke($user, ?string $deviceName): void
    {
        $recoveryCodeBlockLength = (int) config('laravel-extended-auth.recovery-code-block-length', 10);
        $recoveryCodeBlockCount = (int) config('laravel-extended-auth.recovery-code-block-count', 2);
        $recoveryCodesCount = (int) config('laravel-extended-auth.recovery-codes-count', 8);

        $user->twoFactorDevices()->create([
            'device_name' => $deviceName,
            'secret' => encrypt($this->provider->generateSecretKey()),
            'recovery_codes' => encrypt(json_encode(Collection::times($recoveryCodesCount, static function () use ($recoveryCodeBlockLength, $recoveryCodeBlockCount) {
                $blocks = [];

                for ($i = 0; $i <= $recoveryCodeBlockCount; $i++) {
                    $blocks[] = Str::random($recoveryCodeBlockLength);
                }

                return implode('-', $blocks);
            })->all(), JSON_THROW_ON_ERROR)),
        ]);

        TwoFactorAuthenticationEnabled::dispatch($user);
    }
}
