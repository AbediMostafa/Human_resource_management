<?php

namespace App\Models\traits\chat\chat_info;

use App\Models\Chat;
use App\Models\User;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Relations
{

    /**
     * Get chat thread of this chat info
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Get sender of this chat
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
