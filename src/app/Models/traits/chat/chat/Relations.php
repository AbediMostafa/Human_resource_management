<?php

namespace App\Models\traits\chat\chat;

use App\Models\User;
use App\Models\ChatInfo;
use \Illuminate\Database\Eloquent\Relations\MorphTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Relations
{
    /**
     * Get the parent chattable model.
     */
    public function chattable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get chat infos
     */
    public function chatInfos(): HasMany
    {
        return $this->hasMany(ChatInfo::class);
    }

    /**
     * Get users that participated in this chat thread
     */
    public function chatters(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
