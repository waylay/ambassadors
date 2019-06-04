<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $guarded = [];

    public function ambassador()
    {
        return $this->belongsTo('App\Ambassador');
    }
}
