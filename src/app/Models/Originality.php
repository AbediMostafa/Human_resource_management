<?php

namespace App\Models;

use App\Models\traits\originality\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Originality extends Model
{
    use HasFactory, Relations;

    public $timestamps = false;
    protected $guarded = [];
}
