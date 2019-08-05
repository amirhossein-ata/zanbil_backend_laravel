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
            'business' => $this->manager ? $this->manager->business : null,
            'services' => $this->employer ? $this->employer->services : null,
            'reserves' => $this->customer ? $this->customer->reserves : null
        ];
    }
}
