<?php

namespace App\Http\Resources\applicant;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantFullViewResource extends JsonResource
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
            'presenter' => $this->presenter,
            'presenter_user' => $this->presenterUser->fullName(),
            'uid' => $this->uid,
            'status' => $this->status,
            'age' => $this->age,
            'gender' => $this->gender,
            'birth_country' => $this->birthCountry?->title,
            'birth_state' => $this->birthState?->title,
            'birth_city' => $this->birthCity?->title,
            'graduated' => $this->graduated,
            'field_of_study' => $this->fieldOfStudy?->title,
            'grade' => $this->grade,
            'have_job' => $this->have_job,
            'job' => $this->job,
            'job_description' => $this->job_description,
            'job_place' => $this->job_place,
        ];
    }
}
