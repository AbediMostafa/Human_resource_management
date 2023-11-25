<?php

namespace App\Models;

use App\Models\traits\phone\Queries;
use App\Models\traits\phone\Relations;
use App\Models\traits\phone\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory, Relations, Queries, Scopes;

    public $timestamps = false;
    protected $guarded = [];
}
