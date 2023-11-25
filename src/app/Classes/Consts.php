<?php

namespace App\Classes;

class Consts
{
    const LARGE_PAGINATE = 15;
    const SMALL_PAGINATE = 5;
    const MEDIUM_PAGINATE = 7;

    const GRADE = ['student', 'bachelor', 'master', 'Phd','other'];
    const JOB = ['developer', 'seller', 'other'];

    const FAILED_REQUESTS_STAGES = [
        'curl_error',
        'otp_error',
        'mobile_does_not_registered',
        'user_ip_dont_exists',
        'static_password_dont_match',
        'code_was_not_verified',
        'user_signup',
        'unknown'
    ];

    const USER_STATES = [
        'new',
        'active',
        'password_change_request',
    ];

    const PHONE_TYPES = [
        'mobile',
        'home',
        'hashed',
        'encrypted'
    ];
}
