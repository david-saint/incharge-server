<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\General\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends JsonResource
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
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'locations' => $this->whenLoaded('locations', function () {
                return LocationResource::collection($this->locations);
            }),
        ];
    }
}
