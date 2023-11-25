<?php

namespace App\Models\traits\field_of_study;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Relations
{
    /**
     * Get the demand of the history
     */
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
