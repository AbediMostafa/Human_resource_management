<?php

namespace App\Models\traits\city;

use App\Models\State;
use App\Models\Applicant;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Relations
{
    /**
     * Get all applicant based on this country
     */
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }

    /**
     * Get state of this city
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
