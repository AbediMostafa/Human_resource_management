<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends BaseController
{
    /**
     * Get all districts
     */
    public function index()
    {
        return District::all();
    }
}
