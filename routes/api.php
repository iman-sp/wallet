<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Transaction\TransactionController;
use App\Http\Controllers\Api\Wallet\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/auth/validate', [AuthController::class, 'validateCredentials']);

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('wallet')->group(function () {
        Route::get('/', [WalletController::class, 'show']);
    });

    Route::prefix('transaction')->group(function(){
        Route::get('/', [TransactionController::class, 'index']);
        Route::post('/', [TransactionController::class, 'store']);
    });
});