<?php

use App\Http\Controllers\PengajuanSimperApiController;
use App\Http\Controllers\PengajuanStikerApiController;
use App\Http\Controllers\VLStatusApiController;
use App\Models\vl_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/vl_status/{id}',[VLStatusApiController::class,'getStatus']);