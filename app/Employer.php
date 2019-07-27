<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'user_id','business_id'
    ];

    public function business(){
        return $this->belongsTo('App\Business');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
