<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\ShowAdsController;
use App\Http\Controllers\Api\LoginStatusController;

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


Route::post('login' , [AuthenticationController::class , 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthenticationController::class, 'logout']);




Route::middleware('auth:sanctum')->group(function() {

    Route::get('quiz', [ShowAdsController::class, 'quiz']);

    Route::post('/ads', [ShowAdsController::class, 'ads']);

    Route::get('/all-ads', [ShowAdsController::class, 'allAds']);

    Route::post('views', [ShowAdsController::class, 'views']);

    Route::post('login-status' , [LoginStatusController::class , 'loginStatus'])->name('login-status');

});


