<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use Illuminate\Http\Request;

class AuthlessCommonController extends BaseController
{
    /**
     * Get jobs for apis
     */
    public function getJobs(): array
    {
        return Consts::JOB;
    }

    /**
     * Get grades for apis
     */
    public function getGrades(): array
    {
        return Consts::GRADE;
    }
}
