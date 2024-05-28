<?php

namespace App\Http\Controllers;

use App\Http\Requests\Messages\SendRequest;
use App\Services\SignalService;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    public function __construct(protected SignalService $signalService)
    {
    }

    public function postSend(SendRequest $request): JsonResponse
    {
        $response = $this->signalService->sendSignalMessage($request->all());
        return response()->json($response);
    }
}
