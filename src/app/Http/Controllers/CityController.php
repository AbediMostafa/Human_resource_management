<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Classes\Consts;
use JetBrains\PhpStorm\ArrayShape;

class CityController extends BaseController
{
    /**
     * Get all cities
     */
    public function index()
    {
        return City::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )
            ->with('state')
            ->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Create new city
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => City::create(r()->except('method')),
            'created',
            'error',
        );
    }

    /**
     * Update city
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => City::whereId(r('id'))
                ->update(r()->except(['method', 'id'])),
            'updated',
            'error'
        );

    }

    /**
     * Delete country
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function delete(): array
    {
        return tryCatch(
            fn() => City::whereId(r('id'))->delete(),
            'deleted',
            'error'
        );
    }
}
