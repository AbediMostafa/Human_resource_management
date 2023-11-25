<?php

namespace App\Models;

use App\Models\traits\role\Queries;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use Queries;
    public $guarded = [];
}
