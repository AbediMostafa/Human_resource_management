<?php

namespace App\Models\traits\applicant;

use App\Classes\Consts;
use App\Models\Applicant;
use App\Models\City;
use Illuminate\Support\Facades\App;

trait Queries
{

    public static function getAll()
    {
        return Applicant::cardSelect()
            ->withPresenter()
            ->withCityOfResidence()
            ->withOriginality()
            ->searchOnPresenterName()
            ->searchOnGender()
            ->searchOnAge()
            ->searchOnGrade()
            ->searchOnStatus()
            ->searchOnOriginality()
            ->orderBy('id', 'DESC')
            ->paginate(\request('pageSize', Consts::LARGE_PAGINATE));
    }
}
