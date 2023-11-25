<?php

namespace App\Models\traits\user;

use App\Models\User;
use App\Classes\Consts;
use \App\Casts\Encryptor;
use JetBrains\PhpStorm\Pure;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Database\Eloquent\Relations\MorphMany;
use \Illuminate\Database\Eloquent\Model as EloquentModel;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait Queries
{
    /**
     * Get all users with their roles
     */
    public static function getAll(): LengthAwarePaginator
    {
        return User::typicalSelect()
            ->withRoles()
            ->searchOnFullName()
            ->searchOnState()
            ->orderBy('state', 'DESC')
            ->orderBy('id')
            ->paginate(r('pageSize', Consts::LARGE_PAGINATE));
    }

    /**
     * Get specific user
     */
    public static function getUser()
    {
        return User::typicalSelect('getUser')
            ->withRoles()
            ->withApplicants()
            ->withCasts([
                'international_code' => Encryptor::class . ':'.r('token')
            ])
            ->findOrFail(r('id'));
    }

    /**
     * Get user applicants
     */
    public static function getApplicants()
    {
        return User::findOrFail(r('id'))
            ->applicants()
            ->cardSelect()
            ->userApplicantsSearch()
            ->paginate(Consts::MEDIUM_PAGINATE);
    }


    /**
     * Authenticated user's permission names
     */
    public static function loggedInUserPermissions()
    {
        return Auth::user()->allPermissions()->pluck('name')->toArray();
    }

    /**
     * Authenticated user's role names
     */
    public static function loggedInUserRoles()
    {
        return Auth::user()->roles->pluck('display_name')->toArray();
    }

    /**
     * If a user with this hashed phone number exists
     */
    public static function existsWithPhoneNumber($phoneNumber)
    {
        return self::whereMobileIs($phoneNumber)->first();
    }

    /**
     * If a user with this hashed phone number exists
     */
    public static function existsWithNationalCode($nationalCode)
    {
        return self::whereNationalCodeIs($nationalCode)->first();
    }

    /**
     * If a user with this hashed phone number doesn't exist
     */
    public static function doesntExistsWithPhoneNumber($phoneNumber): bool
    {
        return !self::existsWithPhoneNumber($phoneNumber);
    }

    /**
     * If requested user is authenticated user
     */
    public function isNotOwnerUser(): bool
    {
        return Auth::id() != r('id');
    }

    /**
     * returns true if user is new user
     */
    public function stateIs($state): bool
    {
        return $this->state === $state;
    }

    /**
     * User is not a legitimate user
     */
    #[Pure] public function isNotALegitimateUser(): bool
    {
        return !$this->stateIs('new') && !$this->stateIs('active');
    }

    /**
     * Set user state to given state
     */
    public function setStateTo($state)
    {
        $this->state = $state;
        $this->save();
    }

    /**
     * Makes an encrypted or hashed phone number
     */
    public function makeEncryptedPhone($encryptedPhoneNumber, $encryptionMethod = 'encrypted'): static
    {
        $this->phones()->create([
            'number' => $encryptedPhoneNumber,
            'type' => $encryptionMethod
        ]);

        return $this;
    }

    /**
     * Get mobile number of this user
     */
    public function getPhoneNumber($type = 'encrypted'): EloquentModel|MorphMany|null
    {
        return $this->phones()->where([
            'type' => $type
        ])->first();
    }

    /**
     * Makes an encrypted password
     */
    public function makeEncryptedPassword($encryptedPassword): static
    {
        $this->encryptedPassword()->create(
            ['encrypted_password' => $encryptedPassword]
        );

        return $this;
    }

    /**
     * Sync roles with the user
     */
    public function syncRole($role): static
    {
        $this->roles()
            ->sync($role);

        return $this;
    }

}
