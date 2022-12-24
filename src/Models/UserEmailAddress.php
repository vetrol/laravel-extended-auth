<?php

namespace YottaHQ\LaravelExtendedAuth\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use YottaHQ\LaravelExtendedAuth\Exceptions\InvalidOperationException;

class UserEmailAddress extends Model implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @throws InvalidOperationException
     */
    public function setAsPrimary(): void
    {
        $allowUnverified = (bool) config('laravel-extended-auth.allow_unverified_emails_as_primary', false);

        if (!$allowUnverified && !$this->hasVerifiedEmail()) {
            throw new InvalidOperationException("Email address '$this->email' must be verified before it can be set as primary.");
        }

        $primaryEmail = $this->user->email;
        $secondaryEmail = $this->email;
        $primaryVerifiedAt = $this->user->email_verified_at;
        $secondaryVerifiedAt = $this->email_verified_at;

        DB::transaction(function () use ($primaryEmail, $secondaryEmail, $primaryVerifiedAt, $secondaryVerifiedAt) {
            $this->user()->update([
                'email' => $secondaryEmail,
                'email_verified_at' => $secondaryVerifiedAt,
            ]);

            $this->update([
                'email' => $primaryEmail,
                'email_verified_at' => $primaryVerifiedAt,
            ]);
        });
    }
}
