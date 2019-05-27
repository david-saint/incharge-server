<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'code' => $this->code,
            'states' => $this->whenLoaded('states', function () {
                return StateResource::collection($this->states);
            }),
            'locations' => $this->whenLoaded('locations', function () {
                return LocationResource::collection($this->locations);
            }),
        ];
    }
}
