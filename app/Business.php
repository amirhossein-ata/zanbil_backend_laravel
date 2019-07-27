<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name', 'description','address','manager_id', 'price'
    ];

    public function manager(){
        return $this->belongsTo('App\Manager');
    }

    public function employers(){
        return $this->hasMany('App\Employer');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }
}
