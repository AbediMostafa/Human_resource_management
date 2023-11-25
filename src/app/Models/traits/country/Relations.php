<?php

namespace App\Models\traits\country;

use App\Models\State;
use App\Models\Applicant;
use \Illuminate\Database\Eloquent\Relations\HasMany;

trait Relations
{
    /**
     * Get all applicant based on this country
     */
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class,'birth_country');
    }

    /**
     * Get states of this country
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
