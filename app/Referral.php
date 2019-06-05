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

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable');
    }

    public static function laratablesCustomNotes($referral)
    {
        return $referral->notes->load('user');
    }
}
