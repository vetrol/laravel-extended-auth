<?php

namespace YottaHQ\LaravelExtendedAuth\Traits;

use YottaHQ\LaravelExtendedAuth\Models\MagicLink;

trait HasMagicLinks
{
    public function emailAddresses()
    {
        return $this->morphMany(config('laravel-extended-auth.magic_link_model', MagicLink::class), 'magic_linkable');
    }
}
