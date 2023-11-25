<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class ColorController extends BaseController
{
    /**
     * Get all colors
     */
    public function index()
    {
        return Color::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Create new color
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => Color::create(['title' => r('title')]),
            'created',
            'error',
        );
    }

    /**
     * Update color
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => Color::whereId(r('id'))->update(['title' => r('title')]),
            'updated',
            'error'
        );
    }

    /**
     * Delete color
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function delete(): array
    {
        return tryCatch(
            fn() => Color::whereId(r('id'))->delete(),
            'deleted',
            'error'
        );
    }
}
