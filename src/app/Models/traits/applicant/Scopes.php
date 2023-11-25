<?php

namespace App\Models\traits\applicant;

trait Scopes
{
    /**
     * Typical card select
     */
    public function scopeCardSelect($query)
    {
        $query->select(
            'id', 'gender', 'grade', 'uid',
            'presenter', 'age', 'job', 'status',
            'originality_id', 'presenter_id', 'city_of_residence'
        );
    }

    /**
     * Get
     */
    public function scopeWithCityOfResidence($query)
    {
        $query->with([
            'cityOfResidence' => fn($_) => $_->select('title', 'cities.id'),
        ]);
    }

    /**
     * Add originality to applicant query
     */
    public function scopeWithOriginality($query)
    {
        $query->with([
            'originality' => fn($_) => $_->select('title', 'id'),
        ]);
    }

    public function scopeWithPresenter($query)
    {
        $query->with([
            'presenterUser' => fn($_) => $_->select('first_name', 'last_name', 'users.id'),
        ]);
    }

    /**
     * Adds search query on name
     */
    public function scopeSearchOnPresenterName($query)
    {
        $query->when(
            requestHas('search.presenterName'),
            fn($q) => $q->where('presenter', 'like', '%' . r('search.presenterName') . '%')
        );
    }

    /**
     * Adds search query on gender
     */
    public function scopeSearchOnGender($query)
    {
        $query->when(
            r('search.gender') !== 'all',
            fn($q) => $q->where('gender', request('search.gender'))
        );
    }

    /**
     * Adds search query on grade
     */
    public function scopeSearchOnGrade($query)
    {
        $query->when(
            r('search.grade'),
            fn($q) => $q->where('grade', request('search.grade'))
        );
    }

    /**
     * Adds search query on status
     */
    public function scopeSearchOnStatus($query)
    {
        $query->when(
            r('search.status'),
            fn($q) => $q->where('status', r('search.status'))
        );
    }

    public function scopeSearchOnResidenceCity($query)
    {
        $query->when(
            requestHas('search.residenceCity'),
            fn($q) => $q->whereHas('cityOfResidence',
                fn($city) => $city->where('cities.id', r('search.residenceCity'))
            )
        );
    }

    /**
     * Adds search query on originalities
     */
    public function scopeSearchOnOriginality($query)
    {
        $query->when(
            requestHas('search.originality'),
            fn($q) => $q->whereHas('originality',
                fn($originality) => $originality->where('originalities.id', r('search.originality'))
            )
        );
    }

    /**
     * Adds search query on age
     */
    public function scopeSearchOnAge($query)
    {
        $query->when(
            r('search.age') !== 0,
            function ($q) {

                if (r('search.age') == 1) {
                    $q->where('age', '<', 18);
                }

                if (r('search.age') == 2) {
                    $q->where('age', '<', 18)
                        ->where('age', '>', 25);
                }

                if (r('search.age') == 3) {
                    $q->where('age', '<', 25)
                        ->where('age', '>', 35);
                }

                if (r('search.age') == 4) {
                    $q->where('age', '>', 35);
                }
            }
        );
    }
}
