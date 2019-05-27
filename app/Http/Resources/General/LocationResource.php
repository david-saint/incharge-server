<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'state_id' => $this->state_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'state' => $this->whenLoaded('state', function () {
                return new StateResource($this->state);
            }),
            'country' => $this->whenLoaded('country', function () {
                return new CountryResource($this->country);
            }),
            'clinics' => $this->whenLoaded('clinics', function () {
                return GenericNamedResource::collection($this->clinics);
            }),
        ];
    }
}
