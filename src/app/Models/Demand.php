<?php

namespace App\Models;

use App\Models\traits\Commons;
use App\Models\traits\demand\Queries;
use App\Models\traits\demand\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory, Relations, Queries;

    protected $fillable = ['man_id', 'woman_id'];
}
