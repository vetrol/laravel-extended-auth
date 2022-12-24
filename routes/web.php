<?php

use Illuminate\Support\Facades\Route;

Route::get('/email/verify/user-email/{id}/{hash}', [\YottaHQ\LaravelExtendedAuth\Http\Controllers\EmailVerificationController::class, 'verify'])
    ->middleware(config('laravel-extended-auth.verify_route_middleware'))
    ->name('verification.verify-user-email');
