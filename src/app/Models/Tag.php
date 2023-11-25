<?php

namespace App\Models;

use App\Models\traits\tag\Queries;
use App\Models\traits\tag\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Relations, Queries;

    public $timestamps = false;
    protected $guarded = [];
}
