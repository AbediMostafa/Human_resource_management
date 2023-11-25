<?php

namespace App\Models;

use App\Models\traits\color\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory, Relations;

    protected $guarded = [];
    public $timestamps = false;
}
