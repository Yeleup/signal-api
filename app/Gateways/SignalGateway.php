<?php

namespace App\Gateways;

use Illuminate\Support\Facades\Http;

class SignalGateway
{
    public function __construct(protected $baseUrl, protected $number)
    {
    }

    public function sendMessage(string $message, array $recipients, array $base64_attachments = null)
    {
        $response = Http::post("{$this->baseUrl}/v2/send", [
            'number' => $this->number,
            'message' => $message,
            'recipients' => $recipients,
            'base64_attachments' => $base64_attachments,
        ]);

        return $response->json();
    }
}
