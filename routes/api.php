<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::group(['middleware' => 'verify.signal.token'], function () {
    Route::post('/send', [MessageController::class, 'postSend']);
    Route::get('/qrcodelink', [DeviceController::class, 'getQrcodelink']);
});