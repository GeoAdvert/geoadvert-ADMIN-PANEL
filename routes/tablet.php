<?php

use App\Http\Controllers\LoginStatusController;
use App\Http\Controllers\ShowAdsController;
use Illuminate\Support\Facades\Route;


Route::middleware('tabletuser','auth')->prefix('tablet')->group(function () {


        Route::get('/index',function(){
            return view('users.index');
        })->name('index');
        Route::get('/ads',[ShowAdsController::class, 'index'])->name('showAds');
        Route::post('/ads', [ShowAdsController::class, 'getLocation'])->name('getLocation');
        Route::post('views', [ShowAdsController::class, 'views'])->name('views');
        Route::get('/all-ads', [ShowAdsController::class, 'allAds'])->name('allAds');
        Route::post('login-status' , [LoginStatusController::class , 'loginStatus'])->name('login-status');
});

// [ShowAdsController::class, 'index']
