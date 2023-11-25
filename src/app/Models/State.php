<?php

namespace App\Models;

use App\Models\traits\state\Relations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory, Relations;

    public $timestamps = false;
    protected $guarded = [];
}
