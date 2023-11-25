<?php

namespace App\Models;

use App\Models\traits\country\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, Relations;
    public $timestamps = false;

    protected $guarded = [];
}
