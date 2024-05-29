<?php

namespace App\Http\Controllers;

use App\Services\SignalApiService;
use Illuminate\Http\Request;

class SignalApiController
{

    public function __construct(protected SignalApiService $signalApiService)
    {
    }

    public function proxy(Request $request, $path): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return $this->signalApiService->sendRequest($request, $path);
    }
}