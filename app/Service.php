<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'name', 'description', 'business_id', 'employer_id', 'address', 'price',
    ];

    public function timetable(){
        return $this->hasOne('App\Timetable');
    }

    public function reserves(){
        return $this->hasMany('App\Reserve');
    }

    public function business(){
        return $this->belongsTo('App\Business');
    }

    public function employer(){
        return $this->belongsTo('App\Employer');
    }
}
