<?php

namespace App\Models\traits\user;

use App\Models\Chat;
use App\Models\Phone;
use App\Models\Applicant;
use App\Models\EncryptedPassword;
use \Illuminate\Database\Eloquent\Relations\HasOne;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Relations
{
    /**
     * Get applicants of the user
     */
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class, 'presenter_id');
    }

    /**
     * Phones of the user
     */
    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    /**
     * Get users chat threads
     */
    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class);
    }

    /**
     * Get encrypted password of this user
     */
    public function encryptedPassword(): HasOne
    {
        return $this->hasOne(EncryptedPassword::class);
    }
}
