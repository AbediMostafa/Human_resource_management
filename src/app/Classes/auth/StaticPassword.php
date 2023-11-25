<?php

namespace App\Classes\auth;

use App\Models\User;

class StaticPassword
{
    use UserSession;

    public function __construct()
    {
        $this->initAuthSession();
    }


}
