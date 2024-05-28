<?php

namespace App\Http\Controllers;

use App\Http\Requests\Devices\GenerateQrCodeRequest;
use App\Services\SignalService;

class DeviceController extends Controller
{
    public function __construct(protected SignalService $signalService)
    {
    }
    public function getQrcodelink(GenerateQrCodeRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return $this->signalService->generateSignalQrCode($request->all());
    }
}
