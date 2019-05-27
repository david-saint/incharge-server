<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resource\General\GenericNamedResource;
use App\Http\Resource\General\ContraceptionReasonResource;

class ProfileResource extends JsonResource
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
			'age' => $this->age,
			'gender' => $this->gender,
			'date_of_birth' => $this->date_of_birth,
			'address' => $this->address,
			'latitude' => $this->latitude,
			'longitude' => $this->longitude,
			'marital_status' => $this->marital_status,
			'height' => $this->height,
			'weight' => $this->weight,
			'occupation' => $this->occupation,
			'number_of_children' => $this->number_of_children,
			'sexually_active' => $this->sexually_active,
			'pregnancy_status' => $this->pregnancy_status,
			'religion' => $this->religion,
			'religion_sect' => $this->religion_sect,
			'reason' => $this->whenLoaded('reason', function () {
				return new ContraceptionReasonResource($this->reason);
			}),
			'education_level' => $this->whenLoaded('education_level', function () {
				return new GenericNamedResource($this->educationLevel);
			}),
		];
	}
}
