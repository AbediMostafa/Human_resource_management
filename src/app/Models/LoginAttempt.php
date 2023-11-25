<?php

namespace App\Models;

use App\Models\traits\login_attempt\Queries;
use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    use Queries;

    public $timestamps = false;
    protected $guarded = [];
}
