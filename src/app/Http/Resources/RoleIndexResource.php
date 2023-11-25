<?php

namespace App\Http\Resources;

use App\Classes\Consts;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleIndexResource extends JsonResource
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
            'name' => $this->display_name,
            'usersCount' => $this->users_count,
            'permissions' => $this->lessThan7Permissions(),
            'hasMore' => $this->hasMore(),
            'minus' =>$this->minus7()
        ];
    }

    /**
     * Displayable permissions
     *
     * @return mixed
     */
    public function lessThan7Permissions()
    {
        return $this->permissions
            ->map(fn($permission) => $permission->display_name)
            ->take(Consts::MEDIUM_PAGINATE);
    }

    /**
     * If role has more than specific number permissions
     *
     * @return bool
     */
    public function hasMore()
    {
        return $this->permissions?->count() > Consts::MEDIUM_PAGINATE;
    }

    /**
     * Remained permissions after taking away specific permission numbers
     *
     * @return int
     */
    public function minus7()
    {
        return $this->hasMore() ?
            $this->permissions?->count() - Consts::MEDIUM_PAGINATE :
            0;
    }
}
