<?php

namespace App\Models\traits\role;

use App\Classes\Consts;
use App\Models\Role;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Model;

trait Queries
{

    /**
     * Get all roles with permissions and relations counts
     *
     * @return mixed
     */
    public static function getAll()
    {
        return Role::select('id', 'display_name')
            ->withCount('permissions')
            ->withCount('users')
            ->with([
                'permissions' => fn($permissions) => $permissions->select('id', 'display_name')
            ])
            ->orderBy('permissions_count', 'DESC')
            ->paginate(\request('pageSize', Consts::LARGE_PAGINATE));
    }

    /**
     * return role with permissions
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public static function show()
    {
       return Role::with([
            'permissions' => fn($permissions) => $permissions->select(
                'id', 'name', 'display_name', 'description'
            )
        ])
            ->select('id', 'name', 'display_name')
            ->findOrFail(request('roleId'));
    }

    /**
     * Get role users
     *
     * @return mixed
     */
    public static function roleUsers()
    {
        return Role::findOrFail(request('roleId'))
            ->users()
            ->select('id', 'first_name', 'last_name')
            ->paginate(\request('pageSize', Consts::MEDIUM_PAGINATE));
    }

    /**
     * Get role permissions
     *
     * @return mixed
     */
    public static function rolePermissions()
    {
        return Role::findOrFail(request('roleId'))
            ->permissions()
            ->select('id', 'display_name')
            ->get();
    }
}
