<?php

namespace App\Http\Controllers;

use App\Services\SignalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendController extends Controller
{
    public function __construct(protected SignalService $signalService)
    {
    }

    public function send(Request $request): JsonResponse
    {
        $recipients = $request->input('recipients');
        $message = $request->input('message');
        $base64_attachments = $request->input('base64_attachments');
        $response = $this->signalService->sendSignalMessage($message, $recipients, $base64_attachments);
        return response()->json($response);
    }

//    /**
//     * Store a newly created resource in storage.
//     */
//    public function getQRCodeLink()
//    {
//        $url = "http://signal-cli-rest-api:8080/v1/qrcodelink?device_name=signal-api-signal-cli-rest-api-1";
//
//        $client = new \GuzzleHttp\Client();
//
//        try {
//            $response = $client->get($url);
//            $statusCode = $response->getStatusCode();
//            $body = $response->getBody()->getContents();
//            $contentType = $response->getHeader('Content-Type')[0];
//
//            return response($body, $statusCode)->header('Content-Type', $contentType);
//        } catch (\Exception $e) {
//            return response()->json(['error' => $e->getMessage()], 500);
//        }
//    }
//
//    public function register($number): JsonResponse
//    {
//        $response = Http::post('http://signal-cli-rest-api:8080/v1/register/' . $number, [
//            'headers' => [
//                'Content-Type' => 'application/json',
//            ]
//        ]);
//
//        return response()->json($response->json(), $response->status());
//    }
}
