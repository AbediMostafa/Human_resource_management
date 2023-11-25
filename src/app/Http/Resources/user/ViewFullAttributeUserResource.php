<?php

namespace App\Http\Resources\user;

use App\Http\Resources\applicant\ViewApplicantResource;
use App\Http\Resources\phone\ViewPhoneResource;
use App\Http\Resources\role\ViewRoleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ViewFullAttributeUserResource extends JsonResource
{
    public static $wrap = null;

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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->fullName(),
            'state' => $this->state,
            'international_code' => $this->international_code,
            'email' => $this->email,
            'roles' => ViewRoleResource::collection($this->roles),
            'roleIds' => $this->when(
                Auth::user()->isAbleTo('view-user'),
                $this->roles->pluck('id')
            ),
        ];
    }
}
