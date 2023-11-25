<?php

namespace App\Models\traits;

use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Classes\Consts;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait Commons
{
    /**
     * Scope a query to only include applicants with a full name like given phrase
     *
     * @param $query
     * @param $phrase
     * @return mixed
     */
    public function scopeFullNameLike($query, $phrase): mixed
    {
        return $query->where(fn($q) => $q->orWhere(
            DB::raw(
                "CONCAT (first_name,' ' , last_name)",
            ),
            'like',
            '%' . $phrase . '%'
        )
            ->orWhere(
                DB::raw(
                    "CONCAT (first_name , last_name)",
                ),
                'like',
                '%' . $phrase . '%'
            )
        );
    }
}
