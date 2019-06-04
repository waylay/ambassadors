<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    protected $guarded = [];

    public function referrals()
    {
        return $this->hasMany('App\Referral');
    }

    public static function laratablesRoleRelationQuery()
    {
        return function ($query) {
            $query->with('referrals');
        };
    }

    public static function laratablesCustomReferrals($ambassador)
    {
        return implode(" | ",$ambassador->referrals->pluck('name')->all());
    }

    public static function laratablesSearchReferrals($query, $searchValue)
    {
        return $query->orWhereHas('referrals', function($query) use ($searchValue) {
            return $query->where('name', 'like', '%'. $searchValue. '%');
        });
    }
}
