<?php

namespace App\Http\Resources\General;

use App\Http\Resources\Users\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContraceptionReasonResource extends JsonResource
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
            'value' => $this->value,
            'profiles' => $this->whenLoaded('profiles', function () {
                return ProfileResource::collection($this->profiles);
            })
        ];
    }
}
