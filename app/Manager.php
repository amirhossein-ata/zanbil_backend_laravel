<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function business(){
        return $this->hasOne('App\Business');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}

