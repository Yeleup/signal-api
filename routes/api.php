<?php

use App\Http\Controllers\SignalApiController;
use Illuminate\Support\Facades\Route;

Route::any('/signal/{path}', [SignalApiController::class, 'proxy'])
    ->where('path', '.*')->middleware('verify.signal.token');