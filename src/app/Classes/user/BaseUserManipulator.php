<?php

namespace App\Classes\user;


use App\Classes\auth\Encryptor;
use App\Classes\Message;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BaseUserManipulator
{
    protected array $userAttributes;
    protected User $user;

    /**
     * Abort if user with this phone number exists
     */
    public function warnIfUserExistsWithPhoneNumber($phoneNumber): static
    {
        abort_if(
            User::existsWithPhoneNumber($phoneNumber),
            422,
            Message::USER_WITH_THIS_PHONE_REGISTERED_BEFORE
        );

        return $this;
    }

    /**
     * Abort if user with this national code exists
     */
    public function warnIfUserExistsWithNationalCode($internationalCode): static
    {
        abort_if(
            User::existsWithNationalCode($internationalCode),
            422,
            Message::USER_WITH_THIS_NATIONAL_CODE_REGISTERED_BEFORE
        );

        return $this;
    }

    /**
     * Create an empty user
     */
    public function createEmptyUser(): static
    {
        $this->user = new User();
        $this->user->save();

        return $this;
    }

    public function getAttributes(): static
    {
        $this->userAttributes = [
            ...r()->except([
                'international_code', 'jobs', 'method',
                'mobilePhone', 'password', 'roleId'
            ]),
            'job' => implode(',', r('jobs')),
            'international_code' => Encryptor::encryptWithGivenKey(r('password'), r('international_code')),
            'hashed_international_code' => Encryptor::hashHmac(r('international_code')),
            'password' => Hash::make(r('password')),
            'state' => 'active'
        ];

        return $this;
    }

    public function createUser(): static
    {
        $this->user = User::create($this->userAttributes);

        return $this;
    }

    public function updateUser(): static
    {
        $this->user->update($this->userAttributes);

        return $this;
    }
}

