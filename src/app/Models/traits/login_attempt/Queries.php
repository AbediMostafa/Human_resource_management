<?php

namespace App\Models\traits\login_attempt;


trait Queries
{
    public static function saveLoginAttempt($mobile)
    {
        $login_attempt = new self();

        $login_attempt->mobile = $mobile;
        $login_attempt->ip_address = r()->ip();

        $login_attempt->save();

        return $login_attempt;
    }
}
