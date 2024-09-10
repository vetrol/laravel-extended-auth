<?php

use Illuminate\Support\Facades\Route;
use YottaHQ\LaravelExtendedAuth\Http\Controllers\MagicLinkController;

Route::get('/email/verify/user-email/{id}/{hash}', [\YottaHQ\LaravelExtendedAuth\Http\Controllers\EmailVerificationController::class, 'verify'])
    ->middleware(config('laravel-extended-auth.verify_route_middleware'))
    ->name('verification.verify-user-email');

Route::post('/magic-link/send', [MagicLinkController::class, 'send'])->name('magic.link.send');
Route::get('/magic-link/verify/{token}', [MagicLinkController::class, 'verify'])
    ->name('magic.link.verify')
    ->middleware(config('laravel-extended-auth.magic_link_route_middleware'));
