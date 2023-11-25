<?php

namespace App\Classes\auth;

use App\Events\RequestHasErrorEvent;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use JetBrains\PhpStorm\ArrayShape;

class Otp
{
    private string $templateId = "893";
    private string $apiSecret = "7d32b3408410e92c8b6bca6a2c6150ba6d53aba9b965538ba84fffe73ca7acaa";
    public Authenticatable $user;
    protected array $header = [];
    protected array $data = [];
    public string $code = '';
    private $ch;
    private Encryptor $encryptor;

    use UserSession;

    public function __construct(public $mobileNumber = '')
    {
        $this->encryptor = new Encryptor();
        $this->setSessionKey();
    }

    /**
     * Set mobile number
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * If sent code is valid
     */
    public function codeIsValid(): bool
    {
        return r('code') === $this->userSession['code'];
    }

    /**
     * If sent code is not valid
     */
    public function codeIsNotValid(): bool
    {
        return !$this->codeIsValid();
    }

    /**
     * if User exists
     */
    public function userExist(): Authenticatable
    {
        return $this->user = User::existsWithPhoneNumber($this->userSession['mobile']);
    }

    /**
     * Save code to session
     */
    public function saveCodeToSession(): static
    {
        $this->saveNewSession([
            'code' => $this->code,
            'mobile' => $this->mobileNumber
        ]);

        return $this;
    }

    /**
     * Add code verification status to new session
     */
    public function setCodeVerification(): static
    {
        $this->saveNewSession([
            'code_verified' => true,
            'mobile' => $this->userSession['mobile'],
        ]);

        return $this;
    }

    /**
     * Initialize curl
     */
    public function initialize(): static
    {
        $this
            ->generateCode()
            ->saveCodeToSession()
            ->setHeader()
            ->setData()
            ->initCurl();

        return $this;
    }

    /**
     * Generate request header
     */
    protected function setHeader(): static
    {
        $this->header = [
            "api_key:$this->apiKey",
            "api_secret:$this->apiSecret",
            "Content-Type:application/json"
        ];

        return $this;
    }

    /**
     * Set sending data
     */
    #[ArrayShape(["template_id" => "string", "destination" => "string", "parameters" => "string[]"])]
    protected function setData(): static
    {
        $this->data = [
            "template_id" => $this->templateId,
            "destination" => $this->mobileNumber,
            "parameters" => [
                "code" => $this->code,
            ],
        ];

        return $this;
    }

    /**
     * Generate code to be sent to user
     */
    public function generateCode(): static
    {
        $this->code = rand(1220, 9999);
        return $this;
    }

    /**
     * Initialize curl
     */
    protected function initCurl(): static
    {

        $this->ch = curl_init($this->url);
        curl_setopt_array($this->ch, [
            CURLOPT_HTTPHEADER => $this->header,
            CURLOPT_POSTFIELDS => json_encode($this->data),
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        return $this;
    }

    /**
     * Send curl
     */
    #[ArrayShape(['otp' => "\App\Classes\otp\Otp", 'response' => "bool|string", 'errorMsg' => "string"])]
    public function send(): bool
    {
        $response = curl_exec($this->ch);
        $errorMsg = curl_errno($this->ch) ? curl_error($this->ch) : '';

        if ($response) {
            $decodedResponse = json_decode($response);
            return $decodedResponse?->meta?->code === 200 || $this->dispatchFailureEvent($decodedResponse?->meta?->message, 'otp_error');
        }

        return $this->dispatchFailureEvent($errorMsg, 'curl_error');
    }

    /**
     * Dispatch failure event
     */
    public function dispatchFailureEvent($msg, $stage = 'unknown'): bool
    {

        RequestHasErrorEvent::dispatch($msg, $stage, $this->mobileNumber);

        return false;
    }

    /**
     * Get mobile number from stored session
     */
    public function getMobileNumber()
    {
        return $this->userSession['mobile'];
    }
}
