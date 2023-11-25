<?php

namespace App\Models;

use App\Classes\Message;
use App\Models\traits\applicant\Queries;
use App\Models\traits\applicant\Relations;
use App\Models\traits\applicant\Scopes;
use App\Models\traits\Commons;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory, Relations, Queries, Commons, Scopes;

    protected $guarded = [];

    /**
     * Checks if an applicant with this international code registered before
     */
    public static function checkIfApplicantRegisteredBefore($isUpdating = false)
    {
        $hashedInterNationalCode = hash_hmac('sha256', r('international_code'), r('international_code'));
        $applicantExists = Applicant:: when(
        //when we are updating we don't want to check with current id
            $isUpdating,
            fn($query) => $query->where('id', '!=', r('id'))
        )
            ->where('international_code', $hashedInterNationalCode)
            ->exists();

        abort_if($applicantExists, 422, Message::APPLICANT_REGISTERED_BEFORE);
    }
}
