<?php

namespace App\Classes\user;


use App\Classes\auth\Encryptor;
use App\Models\User;

class UserSignUpUpdater extends BaseUserManipulator implements UserManipulatorInterface
{
    public function __construct(protected User $user, protected $mobile)
    {
    }

    public function execute()
    {
        $this
            ->warnIfUserExistsWithNationalCode(r('international_code'))
            ->getAttributes()
            ->updateUser();

        $this->user
            ->makeEncryptedPhone(Encryptor::encryptWithGivenKey(r('password'), $this->mobile))
            ->makeEncryptedPassword(Encryptor::encryptWithPublicKey(r('password')));
    }
}

