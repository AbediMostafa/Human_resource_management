<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\university\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory, Relations;

    public $timestamps = false;
    protected $guarded = [];
}
