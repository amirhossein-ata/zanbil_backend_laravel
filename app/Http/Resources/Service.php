<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Service extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dump($this->timetable);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'address' => $this->address,
            'business' => new Business($this->business),
            'employer' => new Employer($this->employer),
            'timetable' => new Timetable($this->timetable)
        ];
    }
}
