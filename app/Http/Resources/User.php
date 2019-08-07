<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'business' => $this->manager ?  new Business($this->manager->business) : null,
            'services' => $this->employer ? new ServiceCollection($this->employer->services) : null,
            'reserves' => $this->customer ? new ReserveCollection($this->customer->reserves) : null
        ];
    }
}
