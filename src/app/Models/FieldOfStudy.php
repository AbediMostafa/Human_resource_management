<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\field_of_study\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldOfStudy extends Model
{
    use HasFactory, Relations;

    protected $guarded =[];
    public $timestamps =false;
}
