<?php

namespace FTW\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use FTW\Http\Resources\City as CityResource;

class District extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->zipcode,
            'order' => $this->order,
            'city' => CityResource::collection($this->city),
            'status' => $this->status ? 'active' : 'inactive'
        ];
    }
}
