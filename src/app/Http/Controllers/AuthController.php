<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Classes\Message;
use App\Classes\auth\Otp;
use App\Models\LoginAttempt;
use App\Events\RequestHasErrorEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Classes\user\UserSignUpUpdater;
use Symfony\Component\HttpKernel\Exception\HttpException;


class AuthController extends BaseController
{
    public User $user;
    public Otp $otp;
    private array $otpValidation = [
        'getMobileNumber' => [
            'check_if_user_exists_with_phone_number'
        ],
        'verifyOtp' => [
            'check_user_session',
            'check_code_validation',
            'check_if_user_has_not_proper_state',
            'check_if_user_exists_with_session_phone_number'
        ],
        'signup' => [
            'check_user_session',
            'check_code_verification',
            'check_if_user_exists_with_user_id'
        ],
        'verifyPassword' => [
            'check_user_session',
            'check_code_verification',
            'check_if_user_exists_with_user_id'
        ],
        'changePassword' => [
            'check_user_session',
            'check_code_verification',
            'check_if_user_exists_with_user_id'
        ],
        'resendCode' => [
            'check_user_session',
        ],
    ];

    public function login(): array
    {
        $credentials = r()->only('international_code', 'password');

        return Auth::attempt($credentials) ?
            jsonSuccess('Logged in successfully', ["user" => Auth::user()->returnable()]) :
            jsonError('invalid user name or password');
    }

    /**
     * Checks if user is logged in
     */
    public function checkLogin(): bool
    {
        return Auth::check();
    }

    /**
     * Send request to otp message provider and get the response
     */
    public function getMobileNumber(): array
    {
        LoginAttempt::saveLoginAttempt(r('mobile'));
        if ($errors = $this->otpLayerValidation(false)) return $errors;

        try {
            return $this->otp
                ->initialize()
                ->send() ?

                jsonSuccess(Message::ENTER_CODE_SENT) :
                jsonError(Message::PROBLEM_SENDING_CODE);

        } catch (Throwable $e) {

            $this->otp->dispatchFailureEvent($e->getMessage());
            return jsonError(Message::PROBLEM_SENDING_CODE);
        }
    }

    /**
     * Get and check OTP
     */
    public function verifyOtp(): array
    {
        if ($errors = $this->otpLayerValidation()) return $errors;

        try {
            $this->otp->setCodeVerification();

            return jsonSuccess(
                Message::OTP_SUCCESSFUL,
                [
                    //If user is new user(we registered this type of users phone before)
                    //inform the front to show registration component
                    'new_user' => $this->otp->user?->stateIs('new'),
                    'user_id' => $this->otp->user?->id
                ]
            );

        } catch (Throwable $e) {

            $this->otp->dispatchFailureEvent($e->getMessage());
            return jsonError(Message::PROBLEM_VERIFYING_CODE);
        }

    }

    /**
     * Update user information that has been given after otp verification
     */
    public function signup(): array
    {
        if ($errors = $this->otpLayerValidation()) return $errors;

        try {
            $updater = new UserSignUpUpdater($this->user, $this->otp->getMobileNumber());
            $updater->execute();

            Auth::login($this->user);
            return jsonSuccess(Message::SUCCESSFULLY_LOGGED_IN, ["user" => Auth::user()->returnable()]);

        } catch (Throwable $e) {
            if (get_class($e) === 'Symfony\Component\HttpKernel\Exception\HttpException') {
                throw new HttpException(422, $e->getMessage());
            }

            $this->otp->dispatchFailureEvent($e->getMessage(), 'user_signup');
            return jsonError(Message::PROBLEM_UPDATING_USER);
        }
    }

    /**
     * Resend otp code
     */
    public function resendCode(): array
    {
        if ($errors = $this->otpLayerValidation()) return $errors;

        try {
            $this->otp->setMobileNumber(
                $this->otp->getMobileNumber()
            );

            return $this->otp
                ->initialize()
                ->send() ?

                jsonSuccess(Message::ENTER_CODE_SENT) :
                jsonError(Message::PROBLEM_SENDING_CODE);

        } catch (Throwable $e) {

            $this->otp->dispatchFailureEvent($e->getMessage());
            return jsonError(Message::PROBLEM_SENDING_CODE);
        }
    }

    /**
     * Verify user's password
     */
    public function verifyPassword(): array
    {
        if ($errors = $this->otpLayerValidation()) return $errors;

        if (Hash::check(r('password'), $this->user->password)) {
            Auth::login($this->user);
            return jsonSuccess(Message::SUCCESSFULLY_LOGGED_IN, ["user" => Auth::user()->returnable()]);
        }

        return jsonError(Message::WRONG_PASSWORD);
    }

    /**
     * Change user's password
     */
    public function changePassword(): bool|array
    {
        if ($errors = $this->otpLayerValidation()) return $errors;

        return tryCatch(
            fn() => $this->user->setStateTo('password_change_request'),
            'change password submitted successfully',
            'error'
        );
    }

    /**
     * Do a basic validation for multiple route
     */
    public function otpLayerValidation($initialize = true): bool|array
    {
        //If request has mobile we send it to Otp class
        $this->otp = new Otp(r('mobile'));
        $initialize && $this->otp->initAuthSession();

        //Get validation for calling route's action
        $validation = $this->otpValidation[r('method')];

        if (in_array('check_if_user_exists_with_phone_number', $validation))
            if (User::doesntExistsWithPhoneNumber(r('mobile'))) {
                RequestHasErrorEvent::dispatch(Message::MOBILE_NOT_REGISTERED_BEFORE, 'mobile_does_not_registered');
                return jsonError(Message::MOBILE_NOT_REGISTERED_BEFORE);
            }

        //If there is no registered session with user ip
        if (in_array('check_user_session', $validation))
            if ($this->otp->thereIsNoUserSession()) {
                RequestHasErrorEvent::dispatch(Message::PROVIDE_CODE_FROM_SAME_SYSTEM, 'user_ip_dont_exists');
                return jsonError(Message::PROVIDE_CODE_FROM_SAME_SYSTEM);
            }

        //If given code is not valid
        if (in_array('check_code_validation', $validation))
            if ($this->otp->codeIsNotValid())
                return jsonError(Message::OTP_CODE_INCORRECT);

        if (in_array('check_if_user_exists_with_session_phone_number', $validation))
            if (!$this->otp->userExist())
                return jsonError(Message::USER_DOESNT_EXISTS);

        //If this user does not verify before
        if (in_array('check_code_verification', $validation))
            if ($this->otp->otpCodeWasNotVerified()) {
                RequestHasErrorEvent::dispatch(Message::DOESNT_VERIFIED_BEFORE, 'code_was_not_verified');
                return jsonError(Message::DOESNT_VERIFIED_BEFORE);
            }

        if (in_array('check_if_user_exists_with_user_id', $validation))
            if (!$this->user = User::find(r('userId')))
                return jsonError(Message::USER_DOESNT_EXISTS);

        //If User is not active nor new
        if (in_array('check_if_user_has_not_proper_state', $validation))
            if ($this->otp->user->isNotALegitimateUser())
                return jsonError(
                    Message::USER_HAS_NOT_PERMISSION_TO_SIGN_IN,
                    [
                        'change_state' => 1,
                        'state' => ''
                    ]
                );

        return false;
    }

    /**
     * Checks whether given password is correct
     */
    public function checkPassword(): bool
    {
        return Hash::check(r('password'), Auth::user()->password);
    }
}
