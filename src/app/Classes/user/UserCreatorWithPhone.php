<?php

namespace App\Classes\user;


use App\Classes\auth\Encryptor;
use App\Models\User;

class UserCreatorWithPhone extends BaseUserManipulator implements UserManipulatorInterface
{

    public function execute()
    {
        $this->warnIfUserExistsWithPhoneNumber(r('mobilePhone'))
            ->createEmptyUser();

        $this->user
            ->syncRole(r('roleId'))
            ->makeEncryptedPhone(Encryptor::hashHmac(r('mobilePhone')), 'hashed');
    }
}

