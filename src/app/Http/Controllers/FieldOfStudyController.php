<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\FieldOfStudy;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class FieldOfStudyController extends BaseController
{
    /**
     * Get all field of studies
     */
    public function index()
    {
        return FieldOfStudy::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Create new field of study
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => FieldOfStudy::create(['title' => r('title')]),
            'created',
            'error',
        );
    }

    /**
     * Update field of study
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => FieldOfStudy::whereId(r('id'))->update(['title' => r('title')]),
            'updated',
            'error'
        );
    }

    /**
     * Delete field of study
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function delete(): array
    {
        return tryCatch(
            fn() => FieldOfStudy::whereId(r('id'))->delete(),
            'deleted',
            'error'
        );
    }
}
