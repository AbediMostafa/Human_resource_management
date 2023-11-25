<?php

namespace App\Http\Resources\applicant;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewUserApplicantResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'gender' => $this->gender,
            'age' => $this->age,
        ];
    }
}
