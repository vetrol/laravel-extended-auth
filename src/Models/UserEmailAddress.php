<?php

namespace YottaHQ\LaravelExtendedAuth\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use YottaHQ\LaravelExtendedAuth\Exceptions\InvalidOperationException;

class UserEmailAddress extends Model implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    protected $guarded = [];

    public function __construct()
    {
        parent::__construct();
        $this->table = config('laravel-extended-auth.user_email_addresses_table', 'user_email_addresses');
    }

    /**
     * Get the owning model (either User or Admin) of this email address.
     * Polymorphic relation to support different models (User, Admin, etc.)
     */
    public function emailable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Set this email as the primary email for the owning model.
     *
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
