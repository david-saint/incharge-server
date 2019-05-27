<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
			'email' => $this->email,
			'phone' => $this->phone,
			'email_verified' => boolval($this->email_verified_at),
			'phone_confirmed' => boolval($this->phone_confirmed_at),
			'profile' => $this->whenLoaded('profile', function () {
				return new ProfileResource($this->profile);
			}),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
