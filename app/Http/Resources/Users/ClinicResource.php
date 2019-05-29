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
        // Determine the mode defaults to 'kilometers'
        $mode = in_array(strtolower($request->mode), ['km', 'mi']) ? $request->mode : 'km';
        // Determine the circle radius defaults to 10 'kilometers' or 'miles'
        $radius = filter_var($request->radius, FILTER_VALIDATE_INT) !== false ? $request->radius : 10;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'search_radius' => $this->when($this->distance, $radius . $mode),
            'distance' => $this->when($this->distance, function () use ($mode) {
                return $this->distance >= 1 ? round($this->distance, 2) . $mode : 'less than 1' . $mode;
            }),
            'locations' => $this->whenLoaded('locations', function () {
                return LocationResource::collection($this->locations);
            }),
        ];
    }
}
