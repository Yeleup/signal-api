<?php

namespace App\Gateways;

use Illuminate\Support\Facades\Http;

class SignalGateway
{
    public function __construct(protected $baseUrl, protected $number)
    {
    }

    public function sendMessage($params)
    {
        $response = Http::post("{$this->baseUrl}/v2/send", $params);
        return $response->json();
    }

    public function generateQrCode($params): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $response = Http::get("{$this->baseUrl}/v1/qrcodelink", $params);
        return response($response->getBody()->getContents(), $response->status())->header('Content-Type', $response->getHeader('Content-Type')[0]);
    }
}
