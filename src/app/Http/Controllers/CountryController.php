<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\Country;
use JetBrains\PhpStorm\ArrayShape;
use \Illuminate\Database\Eloquent\Collection;

class CountryController extends BaseController
{
    /**
     * Get all countries
     */
    public function index()
    {
        return Country::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Simple country indexing
     */
    public function simpleIndex(): Collection
    {
        return Country::all();
    }

    /**
     * Create new country
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => Country::create(['title' => r('title')]),
            'created',
            'error',
        );
    }

    /**
     * Update country
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => Country::whereId(r('countryId'))->update(['title' => r('title')]),
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
            fn() => Country::whereId(r('countryId'))->delete(),
            'deleted',
            'error'
        );
    }
}
