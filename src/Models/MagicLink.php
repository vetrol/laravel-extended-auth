<?php

namespace YottaHQ\LaravelExtendedAuth\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MagicLink extends Model
{
    protected $guarded = [];

    public function __construct()
    {
        parent::__construct();
        $this->table = config('laravel-extended-auth.magic_links_table', 'magic_links');
    }

    /**
     * Automatically generate a unique token and set the expiry time.
     */
    public static function createForUser($emailable)
    {
        return static::create([
            'emailable_id' => $emailable->id,
            'emailable_type' => get_class($emailable),
            'token' => Str::random(64),
            'expires_at' => Carbon::now()->addMinutes(config('laravel-extended-auth.magic_link_expiry', 60)),
        ]);
    }

    /**
     * Determine if the magic link is expired.
     */
    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    /**
     * Polymorphic relation to the emailable model (User, Admin, etc.).
     */
    public function emailable()
    {
        return $this->morphTo();
    }
}
