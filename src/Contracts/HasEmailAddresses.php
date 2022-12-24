<?php

namespace YottaHQ\LaravelExtendedAuth\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasEmailAddresses
{

    public function emailAddresses(): HasMany;
}
