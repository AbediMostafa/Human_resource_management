<?php

namespace App\Models;

use App\Models\traits\city\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, Relations;

    protected $guarded = [];
    public $timestamps = false;
}
