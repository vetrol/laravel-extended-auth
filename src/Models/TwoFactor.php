<?php

namespace YottaHQ\LaravelExtendedAuth\Models;

use Illuminate\Database\Eloquent\Model;

class TwoFactor extends Model
{
    protected $table = 'two_factor';

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
