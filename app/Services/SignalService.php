<?php

namespace App\Services;

use App\Gateways\SignalGateway;

class SignalService
{
    public function __construct(protected SignalGateway $gateway)
    {
    }

    public function sendSignalMessage($message, $recipients, $base64_attachments = null)
    {
        return $this->gateway->sendMessage($message, $recipients, $base64_attachments);
    }
}
