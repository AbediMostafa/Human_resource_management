<?php

namespace App\Classes\applicant;

use App\Classes\auth\Encryptor;
use App\Classes\Message;
use App\Models\Applicant;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class ApplicantService
{
    /**
     * Create Applicant
     */
    public function create()
    {
        $applicant = Applicant::create(r()->except(
            'method', 'first_name', 'last_name', 'phone',
            'international_code', 'password', 'job',
        ));

        $applicant->first_name = Encryptor::encryptWithGivenKey(r('password'), r('first_name'));
        $applicant->last_name = Encryptor::encryptWithGivenKey(r('password'), r('last_name'));
        $applicant->encrypted_international_code = Encryptor::encryptWithGivenKey(r('password'), r('international_code'));

        $applicant->phones()->create([
            'number' => Encryptor::encryptWithGivenKey(r('password'), r('phone')),
        ]);

        $applicant->international_code = Encryptor::hashHmac(r('international_code'));
        $applicant->presenter_id = Auth::id();

        $this->saveMultiplexProperties($applicant);
    }

    /**
     * Implode array if has element
     */
    public function implode($property): ?string
    {
        return r($property) ? implode(',', r($property)) : null;
    }

    /**
     * Update applicant
     */
    public function update()
    {
        $applicant = Applicant::find(r('id'));

        $applicant->update(r()->except(
            'method', 'id', 'created_at', 'updated_at',
            'international_code','job'
        ));

        r('international_code') &&
        $applicant->international_code = Encryptor::hashHmac(r('international_code'));

        $this->saveMultiplexProperties($applicant);
    }

    /**
     * Save applicant's multiplex properties
     */
    public function saveMultiplexProperties($applicant)
    {
        $applicant->job = $this->implode('job');
        $applicant->uid = $this->getUid($applicant);

        $applicant->save();
    }

     * Generate UID
     */
    public function getUid($applicant): string
    {
        //Get 3 last digit of birth year
        $birthYear = substr(r('birth_year'), -3);
        $cityOfResidence = City::find(r('city_of_residence'))?->abbr ?? 'FOREIGN';
        $gender = substr(r('gender'), 0, 1);

        return $gender . $birthYear . $cityOfResidence . $applicant->id;
    }
}
