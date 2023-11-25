<?php

namespace App\Models\traits\permission;

use App\Classes\Consts;
use App\Models\Permission;
use App\Models\Role;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Model;

trait Queries
{
    /**
     * Get all permissions
     */
    public static function getAll()
    {
        return Permission::typicalSelect()
            ->getRoles()
            ->doSearch()
            ->paginate(Consts::LARGE_PAGINATE);
    }
}
