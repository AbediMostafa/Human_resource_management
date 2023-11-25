<?php

namespace App\Models;

use App\Models\traits\chat\chat\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory, Relations;
}
