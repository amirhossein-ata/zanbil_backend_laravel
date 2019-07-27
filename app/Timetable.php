<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = [
        'service_id', 'start_day', 'start_middle_rest',
        'end_middle_rest', 'end_day', 'time_length', 'gap_length'
    ];

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
