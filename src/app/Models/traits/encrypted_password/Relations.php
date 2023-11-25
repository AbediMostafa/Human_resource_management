<?php

namespace App\Models\traits\encrypted_password;


use App\Models\User;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Relations
{
    /**
     * Get user of this encrypted password
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
