<?php

namespace App\Http\Controllers;

use App\Http\Resources\role\RolePermissionsRequest;
use App\Http\Resources\role\RoleShowResource;
use App\Http\Resources\role\RoleUsersRequest;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\role\SingleRoleResource;
use App\Http\Resources\RoleIndexResource;
use App\Models\Role;

class RoleController extends BaseController
{
    /**
     * Get all roles
     */
    public function index(): AnonymousResourceCollection
    {
        return RoleIndexResource::collection(Role::getAll());
    }

    /**
     * Get role with permissions
     */
    public function show()
    {
        return new RoleShowResource(Role::show());
    }

    /**
     * Get users of specified user
     */
    public function roleUsers()
    {
        return RoleUsersRequest::collection(Role::roleUsers());
    }

    /**
     * Get permissions of specified user
     */
    public function rolePermissions()
    {
        return RolePermissionsRequest::collection(Role::rolePermissions());
    }

    /**
     * Update role and it's permissions
     */
    public function update()
    {

        return tryCatch(
            function () {
                $role = Role::findOrFail(request('role.id'));
                $role->update([
                    'name' => request('role.name'),
                    'display_name' => request('role.displayName'),
                ]);

                $role->permissions()->sync(request('role.permissionIds'));
            },
            'updated',
            'error'
        );

    }

    /**
     * Update role and it's permissions
     */
    public function delete()
    {
        return tryCatch(
            fn() => Role::whereId(request('roleId'))->delete()
            ,
            'deleted',
            'error'
        );
    }

    /**
     * Crate new role
     */
    public function create()
    {
        return tryCatch(
            function () {
                $role = Role::create([
                    'name' => request('role.name'),
                    'display_name' => request('role.displayName'),
                ]);

                $role->permissions()->attach(request('role.permissionIds'));
            },
            'created',
            'error'
        );
    }
}
