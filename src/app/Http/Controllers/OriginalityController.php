<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\Originality;
use JetBrains\PhpStorm\ArrayShape;

class OriginalityController extends BaseController
{
    /**
     * Get all originalities
     */
    public function index()
    {
        return Originality::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Create new originality
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => Originality::create(['title' => r('title')]),
            'created',
            'error',
        );
    }

    /**
     * Update originality
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => Originality::whereId(r('id'))->update(['title' => r('title')]),
            'updated',
            'error'
        );
    }

    /**
     * Delete originality
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function delete(): array
    {
        return tryCatch(
            fn() => Originality::whereId(r('id'))->delete(),
            'deleted',
            'error'
        );
    }
}
