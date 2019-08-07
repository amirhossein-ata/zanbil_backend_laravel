<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reserve extends JsonResource
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
            'reserve_date' => $this->reserve_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'service' => new Service($this->service),
            'customer' => $this->customer_id
        ];
    }
}
