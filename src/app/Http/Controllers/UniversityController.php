<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\University;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;

class UniversityController extends BaseController
{
    /**
     * Get all universities
     */
    public function index()
    {
        return University::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Create new university
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => University::create(['title' => r('title')]),
            'created',
            'error',
        );
    }

    /**
     * Update university
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => University::whereId(r('id'))->update(['title' => r('title')]),
            'updated',
            'error'
        );
    }

    /**
     * Delete university
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function delete(): array
    {
        return tryCatch(
            fn() => University::whereId(r('id'))->delete(),
            'deleted',
            'error'
        );
    }
}
