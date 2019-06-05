<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

	public $timestamps = false;

	protected $dates = ['created_at'];

    public function user() {
    	return $this->belongsTo('\App\User');
    }

	public function notable()
    {
        return $this->morphTo();
    }

    public function getNoteAttribute($note) {
    	return e($note);
    }

}
