<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\DemandIndexResource;
use App\Classes\Message;
use App\Models\Demand;
use JetBrains\PhpStorm\ArrayShape;

class DemandController extends BaseController
{
    /**
     * Get all demands
     */
    public function index(): AnonymousResourceCollection
    {
        return DemandIndexResource::collection(Demand::getAll());
    }
}
