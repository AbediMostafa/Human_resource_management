<?php

namespace App\Models\traits\permission;

trait Scopes
{

    public function scopeTypicalSelect($query)
    {
        $query->select('id', 'name', 'display_name', 'description');
    }

    public function scopeGetRoles($query)
    {
        $query->with([
            'roles' => fn($_) => $_->select('id', 'display_name')
        ]);
    }

    public function scopeDoSearch($query)
    {
        $query->when(
            \request('searchKey'),
            fn($_) => $_->where('display_name', 'like', '%' . \request('searchKey') . '%')
                ->orWhere('name', 'like', '%' . \request('searchKey') . '%')
        );
    }

}
