<?php

namespace App\Models\traits\state;

use App\Models\City;
use App\Models\Country;
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
     * Get country of this state
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get cities of this state
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
