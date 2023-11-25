<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;

class StateController extends BaseController
{
    /**
     * Get all states
     */
    public function index()
    {
        return State::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )
            ->with('country')
            ->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Simple country indexing
     */
    public function simpleIndex(): Collection
    {
        return State::select('id', 'title')->get();
    }

    /**
     * Create new state
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => State::create(r()->except('method')),
            'created',
            'error',
        );
    }

    /**
     * Update state
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => State::whereId(r('id'))
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
            fn() => State::whereId(r('stateId'))->delete(),
            'deleted',
            'error'
        );
    }
}

