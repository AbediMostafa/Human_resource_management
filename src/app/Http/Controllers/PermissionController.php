<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Resources\permissoin\PermissionResource;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionController extends BaseController
{
    /**
     * Gets permission listing
     */
    public function index(): AnonymousResourceCollection
    {
        return PermissionResource::collection(Permission::getAll());
    }

    /**
     * Delete permission
     */
    public function delete(): array
    {
        return tryCatch(
            fn() => Permission::whereId(request('permissionId'))->delete()
            ,
            'created',
            'error'
        );
    }

    /**
     * Permission view
     */
    public function view()
    {
        return Permission::whereId(request('permissionId'))
            ->select('id', 'name', 'display_name', 'description')
            ->first();
    }

    /**
     * Update permission
     */
    public function update()
    {
        return tryCatch(
            fn() => Permission::whereId(request('permission.id'))
                ->update([
                    'name' => request('permission.name'),
                    'display_name' => request('permission.display_name'),
                    'description' => request('permission.description'),
                ])
            ,
            'updated',
            'error'
        );
    }

    /**
     * Create permission
     */
    public function create(): array
    {
        return tryCatch(
            fn() => Permission::create([
                'name' => request('permission.name'),
                'display_name' => request('permission.display_name'),
                'description' => request('permission.description'),
            ])
            ,
            'created',
            'error'
        );
    }
}
