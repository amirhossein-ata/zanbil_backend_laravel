<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id'
    ];
    public function reserves(){
        return $this->hasMany('App\Reserve');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
