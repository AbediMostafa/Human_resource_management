<?php

namespace App\Http\Resources\applicant;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'uid'=>$this->uid,
            'gender'=>$this->gender,
            'grade'=>$this->grade,
            'presenter'=>$this->presenter,
            'age'=>$this->age,
            'job'=>$this->job,
            'status'=>$this->status,
            'cityOfResidence'=>$this->cityOfResidence?->title,
        ];
    }
}
