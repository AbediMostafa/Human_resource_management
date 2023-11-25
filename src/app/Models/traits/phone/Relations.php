<?php

namespace App\Models\traits\phone;

trait Relations
{
    /**
     * Get the parent phonable model (applicant or user).
     */
    public function phonable()
    {
        return $this->morphTo();
    }
}
