<?php

namespace App\Http\Controllers;

use App\Http\Resources\applicant\ApplicantFullViewResource;
use App\Http\Resources\applicant\ApplicantIndexResource;
use App\Models\City;
use App\Models\Country;
use App\Classes\Consts;
use App\Models\Applicant;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;
use App\Classes\applicant\ApplicantService;
use App\Http\Resources\applicant\ViewApplicantResource;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApplicantController extends BaseController
{

    /**
     * Get all applicants
     */
    public function index(): AnonymousResourceCollection
    {
        return ApplicantIndexResource::collection(Applicant::getAll());
    }

    /**
     * Get all applicants for drop dawn
     */
    #[ArrayShape(['males' => "mixed", 'females' => "mixed"])]
    public function getApplicants(): array
    {
        $all = Applicant::select('uid as label', 'id as value', 'gender')->get();

        return [
            'males' => $all->where('gender', 'male'),
            'females' => $all->where('gender', 'female')
        ];
    }

    /**
     * Create new applicant
     */
    public function create(): array
    {
        Applicant::checkIfApplicantRegisteredBefore();

        return tryCatch(
            fn() => (new ApplicantService())->create(),
            'created',
            'error'
        );
    }

    /**
     * Delete applicant
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function delete(): array
    {
        return tryCatch(
            fn() => Applicant::destroy(r('appId')),
            '  success',
            'error',
        );

    }

    public function getApplicant()
    {
        $applicant = Applicant::find(r('applicantId'));
        $applicant->job = explode(',', $applicant->job);

        return $applicant;

    }

    /**
     * Get applicant
     */
    public function view()
    {
        return Applicant::find(r('applicantId'));
    }

    /**
     * Get applicant's full properties (with birth country,state etc.)
     */
    public function fullView()
    {
        $applicant = Applicant::with(
            'birthCity',
            'studyCity',
            'birthState',
            'studyState',
            'originality',
            'studyCountry',
            'fieldOfStudy',
            'birthCountry',
            'presenterUser',
            'cityOfResidence',
            'countryOfResidence',
        )
            ->find(r('applicantId'));

        return new ApplicantFullViewResource($applicant);
    }

    /**
     * Get applicant locations
     */
    #[ArrayShape(['birthStates' => "mixed", 'birthCities' => "mixed", 'studyStates' => "mixed", 'studyCities' => "mixed", 'residenceStates' => "mixed", 'residenceCities' => "mixed", 'futureResidenceStates' => "mixed", 'futureResidenceCities' => "mixed"])]
    public function getApplicantLocations(): array
    {
        $applicant = Applicant::find(r('applicantId'));

        return [
            'birthStates' => Country::find($applicant->birth_country)?->states,
            'birthCities' => State::find($applicant->birth_state)?->cities,

            'studyStates' => Country::find($applicant->study_country)?->states,
            'studyCities' => State::find($applicant->study_state)?->cities,

            'residenceStates' => Country::find($applicant->country_of_residence)?->states,
            'residenceCities' => State::find($applicant->state_of_residence)?->cities,

            'futureResidenceStates' => Country::find($applicant->future_residence_country)?->states,
            'futureResidenceCities' => State::find($applicant->future_residence_state)?->cities,
        ];
    }

    /**
     * Update applicant
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        Applicant::checkIfApplicantRegisteredBefore($isUpdating = true);

        return tryCatch(
            fn() => (new ApplicantService())->update(),
            '  success',
            'error',
        );
    }

    /**
     * Get list of users for applicant dropdown search
     */
    public function getUsers(): mixed
    {
        return User::when(
            r('query'),
            fn($q) => $q->fullNameLike(r('query'))
        )
            ->select('id as value', DB::raw(
                "CONCAT (first_name,' ' , last_name) as label",
            ))
            ->get();
    }

    /**
     * Get list of users for applicant dropdown search
     */
    public function getCities(): mixed
    {
        return City::when(
            r('query'),
            fn($q) => $q->where('title', 'like', '%' . r('query') . '%')
        )
            ->select('id as value','title as label')
            ->get();
    }
}
