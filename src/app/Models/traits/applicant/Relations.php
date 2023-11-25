<?php

namespace App\Models\traits\applicant;

use App\Models\FieldOfStudy;
use App\Models\City;
use App\Models\Phone;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Originality;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use \Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Relations
{

    /**
     * Get originality of the applicant
     */
    public function originality(): BelongsTo
    {
        return $this->belongsTo(Originality::class);
    }

    /**
     * Get presenter of this applicant
     */
    public function presenterUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'presenter_id');
    }

    /**
     * Get birth country of the applicant
     */
    public function birthCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'birth_country');
    }

    /**
     * Get birth state of the applicant
     */
    public function birthState(): BelongsTo
    {
        return $this->belongsTo(State::class, 'birth_state');
    }

    /**
     * Get birth city of the applicant
     */
    public function birthCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'birth_city');
    }

    /**
     * Get study country of the applicant
     */
    public function studyCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'study_country');
    }

    /**
     * Get study state of the applicant
     */
    public function studyState(): BelongsTo
    {
        return $this->belongsTo(State::class, 'study_state');
    }

    /**
     * Get study city of the applicant
     */
    public function studyCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'study_city');
    }

    /**
     * Get country of residence of applicant
     */
    public function countryOfResidence(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_of_residence');
    }

    /**
     * Get state of residence of applicant
     */
    public function stateOfResidence(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_of_residence');
    }

    /**
     * Get city of residence of applicant
     */
    public function cityOfResidence(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_of_residence');
    }

    /**
     * Get field of study of the applicant
     */
    public function fieldOfStudy(): BelongsTo
    {
        return $this->belongsTo(FieldOfStudy::class);
    }

    /**
     * Phones of the applicant
     */
    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }
}
