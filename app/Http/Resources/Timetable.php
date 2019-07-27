<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Timetable extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'start_day' => $this->start_day,
            'end_day'=> $this->end_day,
            'start_middle_rest' => $this->start_middle_rest,
            'end_middle_rest' => $this->end_middle_rest,
            'time_length' => $this->time_length,
            'gap_length' => $this->gap_length,
            'service_id' => $this->service_id
        ];
    }
}
