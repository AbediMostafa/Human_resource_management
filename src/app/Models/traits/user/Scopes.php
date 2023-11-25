<?php

namespace App\Models\traits\user;

use App\Classes\auth\Encryptor;
use App\Models\User;

trait Scopes
{
    /**
     * Common select columns
     */
    public function scopeTypicalSelect($query, $method = 'getAll')
    {
        $commonAttributes = [
            'users.id',
            'first_name',
            'last_name',
            'state',
        ];

        $specificAttributes = [
            'getUser' => [
                'international_code'
            ],

            'getAll' => []
        ];

        $query->select(...[...$commonAttributes, ...$specificAttributes[$method]]);
    }

    /**
     * Add roles relationship
     */
    public function scopeWithRoles($query)
    {
        $query->with([
            'roles' => fn($roles) => $roles->select('roles.id', 'display_name'),
        ]);
    }

    /**
     * Add applicants to the relationship
     */
    public function scopeWithApplicants($query)
    {
        $query->with([
            'applicants' => fn($_) => $_->select('id', 'presenter_id', 'age', 'international_code', 'gender'),
        ]);
    }

    /**
     * Search on full name
     */
    public function scopeSearchOnFullName($query)
    {
        $query->when(
            requestHas('search.fullName'),
            fn($q) => $q->fullNameLike(request('search.fullName'))
        );
    }

    /**
     * Search on full name
     */
    public function scopeSearchOnState($query)
    {
        $query->when(
            requestHas('search.state'),
            fn($q) => $q->whereIn('state', r('search.state'))
        );
    }

    /**
     * update model
     */
    public function scopeDoUpdate($query)
    {
        $query->update(
            r()->only(
                'first_name',
                'last_name',
                'international_code',
                'email'
            ));
    }

    /**
     * return user with this number
     */
    public function scopeWhereMobileIs($query, $number, $isHashed = true)
    {
        //We store two type of phone number:
        //1-hashed : for checking if user with this phone number exists
        //2-encrypted : it's returnable with user's password key
        //Here we are checking if any user with this hashed phone number exists
        $whetherHashedOrNot = $isHashed ? Encryptor::hashHmac($number) : $number;

        return $query->whereHas(
            'phones',
            fn($_) => $_->where('number', $whetherHashedOrNot)
        );
    }

    /**
     * return user with this National code
     */
    public function scopeWhereNationalCodeIs($query, $nationalCode, $isHashed = true)
    {
        $whetherHashedOrNot = $isHashed ? Encryptor::hashHmac($nationalCode) : $nationalCode;

        return $query->where('hashed_international_code', $whetherHashedOrNot);
    }
}
