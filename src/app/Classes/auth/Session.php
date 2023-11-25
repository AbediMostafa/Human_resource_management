<?php

namespace App\Classes\auth;

use App\Classes\Message;
use Throwable;


class Session
{
    const MAX_ATTEMPT = 5;
    const MAX_ALLOWED_PASSED_TIME = 60;/* Second */
    protected $session = '';
    protected $sessionAsJson = '';
    protected $attempts = [];


    public function __construct()
    {
        $this->parseSession()
            ->checkAttempts();
    }

    /**
     * Parse ip session
     */
    public function parseSession(): static
    {
        $this->session = session(r()->ip());

        if ($this->session) {
            try {
                $this->sessionAsJson = json_decode($this->session);
                $this->attempts = $this->sessionAsJson['attempts'];

            } catch (Throwable $e) {
                abort(422, Message::SESSION_PARSING_PROBLEM);
            }
        }

        return $this;
    }

    /**
     * Check max attempts in specific time
     */
    public function checkAttempts(): bool
    {
        return $this->maxAttemptExceeded() && $this->notMuchPassedSinceFirstAttempts();
    }

    /**
     * If number of attempts is more than 4
     */
    public function maxAttemptExceeded(): bool
    {
        return count($this->attempts) === self::MAX_ATTEMPT;
    }

    /**
     * If MAX_ALLOWED_PASSED_TIME second passed since first attempt
     */
    public function notMuchPassedSinceFirstAttempts(): bool
    {
        $firstAttempt = $this->attempts[0];

        return now() - $firstAttempt < self::MAX_ALLOWED_PASSED_TIME;
    }
}
