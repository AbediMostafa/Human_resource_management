<?php

namespace App\Models\traits\originality;

use App\Models\Applicant;

trait Relations
{

    /**
     * Get all applicants who have this originality
     */
    public function applicants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
