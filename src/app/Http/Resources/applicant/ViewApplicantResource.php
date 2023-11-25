<?php

namespace App\Http\Resources\applicant;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewApplicantResource extends JsonResource
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
            'fullName' => $this->fullName(),
            'gender'=>$this->gender,
            'age'=>$this->age,
            'internationalCode' => $this->international_code,
        ];
    }
}
