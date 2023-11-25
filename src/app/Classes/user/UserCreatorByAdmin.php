<?php

namespace App\Classes\user;


use App\Classes\auth\Encryptor;

class UserCreatorByAdmin extends BaseUserManipulator implements UserManipulatorInterface
{

    public function execute()
    {
        $this->warnIfUserExistsWithPhoneNumber(r('mobilePhone'))
            ->warnIfUserExistsWithNationalCode(r('international_code'))
            ->getAttributes()
            ->createUser();

        $this->user
            ->syncRole(r('roleId'))
            ->makeEncryptedPhone(Encryptor::hashHmac(r('mobilePhone')), 'hashed')
            ->makeEncryptedPhone(Encryptor::encryptWithGivenKey(r('password'), r('mobilePhone')))
            ->makeEncryptedPassword(Encryptor::encryptWithPublicKey(r('password')));
    }

}

