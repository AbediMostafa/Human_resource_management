<?php

namespace App\Models;

use App\Models\traits\encrypted_password\Queries;
use App\Models\traits\encrypted_password\Relations;
use App\Models\traits\encrypted_password\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncryptedPassword extends Model
{
    use HasFactory, Scopes, Queries, Relations;

    protected $guarded = [];
    public $timestamps = false;
}
