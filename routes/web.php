<?php

use Illuminate\Support\Facades\Route;
use YottaHQ\LaravelExtendedAuth\Http\Controllers\TwoFactorAuthenticationController;

Route::get('/email/verify/user-email/{id}/{hash}', [\YottaHQ\LaravelExtendedAuth\Http\Controllers\EmailVerificationController::class, 'verify'])
    ->middleware(config('laravel-extended-auth.verify_route_middleware'))
    ->name('verification.verify-user-email');


$twoFactorMiddleware = config('laravel-extended-auth.auth_middleware', ['auth']);

Route::post('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])
    ->middleware($twoFactorMiddleware)
    ->name('two-factor.enable');

Route::post('/user/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthenticationController::class, 'store'])
    ->middleware($twoFactorMiddleware)
    ->name('two-factor.confirm');

Route::delete('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
    ->middleware($twoFactorMiddleware)
    ->name('two-factor.disable');

Route::get('/user/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
    ->middleware($twoFactorMiddleware)
    ->name('two-factor.qr-code');

Route::get('/user/two-factor-secret-key', [TwoFactorSecretKeyController::class, 'show'])
    ->middleware($twoFactorMiddleware)
    ->name('two-factor.secret-key');

Route::get('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
    ->middleware($twoFactorMiddleware)
    ->name('two-factor.recovery-codes');

Route::post('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
    ->middleware($twoFactorMiddleware);
