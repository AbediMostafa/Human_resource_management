<?php

namespace App\Http\Controllers;

use App\Classes\Consts;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;

class TagController extends BaseController
{
    /**
     * Get tags
     */
    public function index(): mixed
    {
        return Tag::select('id as value', 'title as label')->get();
    }

    /**
     * Get all tags
     */
    public function indexing()
    {
        return Tag::when(
            r('key'),
            fn($q) => $q->where('title', 'like', '%' . r('key') . '%')
        )->paginate(Consts::SMALL_PAGINATE);
    }

    /**
     * Simple Tag indexing
     */
    public function simpleIndex(): Collection
    {
        return Tag::all();
    }

    /**
     * Create new Tag
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => Tag::create(['title' => r('title')]),
            'created',
            'error',
        );
    }

    /**
     * Update Tag
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            fn() => Tag::whereId(r('id'))->update(['title' => r('title')]),
            'updated',
            'error'
        );
    }

    /**
     * Delete Tag
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function delete(): array
    {
        return tryCatch(
            fn() => Tag::whereId(r('id'))->delete(),
            'deleted',
            'error'
        );
    }
}
