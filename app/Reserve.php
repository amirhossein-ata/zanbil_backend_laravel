<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    public function Customer(){
        return $this->belongsTo('App\Customer');
    }

    public function Service(){
        return $this->belongsTo('App\Service');
    }
}
