<?php

namespace App\Http\Resources;

use App\Http\Resources\role\ViewRoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->fullName(),
            'international_code' => $this->international_code,
            'roles' => ViewRoleResource::collection($this->roles),
            'state' => $this->state
        ];
    }
}
