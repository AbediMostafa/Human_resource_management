<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\Country;
use App\Models\FieldOfStudy;
use App\Models\Originality;
use App\Models\Permission;
use App\Models\Role;
use App\Models\State;
use App\Models\University;
use App\Models\User;
use JetBrains\PhpStorm\ArrayShape;

class CommonController extends BaseController
{
    /**
     * Roles for common usages
     */
    public function getRoles()
    {
        return Role::select('id', 'display_name')->get();
    }

    /**
     * Permissions for dropdown usages
     */
    public function getPermissions()
    {
        return Permission::select('id', 'name', 'display_name', 'description')->get();
    }

    /**
     * Users for common usages
     */
    public function getUsers()
    {
        return User::select('id', 'first_name', 'last_name', 'international_code')->get();
    }

    /**
     * Get all originalities
     */
    public function getOriginalities()
    {
        return Originality::select('id', 'title')->get();
    }

    /**
     * Create applicant apis
     */
    public function createApplicantApis(): array
    {
        return [
            'countries' => Country::all(),
            'fieldOfStudy' => FieldOfStudy::all(),
            'grade' => Consts::GRADE,
            'universities' => University::all(),
            'jobs' => Consts::JOB,
            'status' => Consts::APPLICANT_STATUS,
        ];
    }

    /**
     * Apis for applicants advance search
     */
    public function applicantAdvanceSearchApi(): array
    {
        return [
            'grade' => Consts::GRADE,
            'status' => Consts::APPLICANT_STATUS,
            'originalities' => Originality::all(),
        ];
    }

    /**
     * Get states of given country
     */
    public function getStatesOfCountry()
    {
        return Country::find(r('id'))?->states;
    }

    /**
     * Get cities of given state
     */
    public function getCitiesOfState()
    {
        return State::find(r('id'))?->cities;
    }

    /**
     * Get jobs for apis
     */
    public function getJobs(): array
    {
        return Consts::JOB;
    }
}
