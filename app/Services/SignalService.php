<?php

namespace App\Services;

use App\Gateways\SignalGateway;

class SignalService
{
    public function __construct(protected SignalGateway $gateway)
    {
    }

    public function sendSignalMessage(array $params)
    {
        return $this->gateway->sendMessage($params);
    }

    public function generateSignalQrCode(array $params): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return $this->gateway->generateQrCode($params);
    }
}
