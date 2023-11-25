<?php

namespace App\Events;

use App\Models\FailedRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RequestHasErrorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(private $msg, private $stage = 'unknown', private $mobileNumber = null)
    {
        $this->addFailedRequestRecord();
    }

    /**
     * Add one record to explain send sms reason
     */
    public function addFailedRequestRecord()
    {
        return FailedRequest::create([
            'ip' => r()->ip(),
            'phone' => $this->mobileNumber,
            'message' => $this->msg,
            'stage' => $this->stage
        ]);
    }
}
