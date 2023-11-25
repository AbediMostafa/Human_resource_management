<?php

namespace App\Classes\auth;


use App\Models\User;

trait UserSession
{
    private string $sessionKey;
    public mixed $userSession;


    public function initAuthSession()
    {
        $this->setUserSession();
    }

    /**
     * Set session key as current user's ip
     */
    private function setSessionKey()
    {
        $this->sessionKey = str_replace('.', '-', r()->ip());
    }

    /**
     * Set user session
     */
    public function setUserSession(): static
    {
        $this->userSession = session($this->sessionKey) ?? null;

        return $this;
    }

    /**
     * Forget user session
     */
    private function forgetUserSession(): static
    {
        session()->forget($this->sessionKey);
        session()->save();

        return $this;
    }

    /**
     * If there is no user session
     */
    public function thereIsNoUserSession(): bool
    {
        return !$this->userSession;
    }

    /**
     * Set new session with user's IP key and given array
     */
    public function saveNewSession(array $arr)
    {
        session([$this->sessionKey => $arr]);
    }

    /**
     * If otp code has verified before
     */
    public function otpCodeWasVerified(): bool
    {
        return $this->userSession && $this->userSession['code_verified'];
    }

    /**
     * If otp code has not verified before
     */
    public function otpCodeWasNotVerified(): bool
    {
        return !$this->otpCodeWasVerified();
    }
}
