<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\chat\chat_info\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatInfo extends Model
{
    use HasFactory, Relations;
}
