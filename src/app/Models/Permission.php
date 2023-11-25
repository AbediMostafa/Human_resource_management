<?php

namespace App\Models;

use App\Models\traits\permission\Queries;
use App\Models\traits\permission\Relations;
use App\Models\traits\permission\Scopes;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use Relations, Scopes, Queries;
    public $guarded = [];
}
