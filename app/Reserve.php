<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $fillable = [
        'service_id', 'customer_id', 'start_time', 'end_time', 'reserve_date'
    ];

    public function Customer(){
        return $this->belongsTo('App\Customer');
    }

    public function Service(){
        return $this->belongsTo('App\Service');
    }
}
