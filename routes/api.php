<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ResidentController;
use App\Http\Controllers\Api\HouseResidentController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PaymentTypeController;
use App\Http\Controllers\Api\ReportController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::apiResource('houses', HouseController::class);
    Route::apiResource('residents', ResidentController::class);
    Route::apiResource('house-residents', HouseResidentController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::get(
        '/payment-types',
        [PaymentTypeController::class, 'index']
    );
    Route::apiResource('expenses', ExpenseController::class);

    Route::get(
        '/reports/monthly-financial',
        [ReportController::class, 'monthlyFinancial']
    );
});
