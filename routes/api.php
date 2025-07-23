<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\PaymentController as ApiPaymentController;
use App\Http\Controllers\Api\SliderApiController;
use App\Http\Controllers\Api\PageApiController;
use App\Http\Controllers\Api\SupportTicketController;
use App\Http\Controllers\Api\ReportApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\SubscriptionApiController;
use App\Http\Controllers\Api\WalletApiController;




Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Forgot Password Flow
Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp']);
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword']);

Route::get('/subscriptions', [SubscriptionApiController::class, 'index']);


Route::get('/products', [ProductApiController::class, 'index']);   
Route::get('/products/{id}', [ProductApiController::class, 'show']);

Route::get('/wallets', [WalletApiController::class, 'index']);
Route::get('/wallets/{id}', [WalletApiController::class, 'show']);


Route::get('/orders', [OrderApiController::class, 'index']);
Route::get('/orders/{id}', [OrderApiController::class, 'show']);
Route::post('/orders', [OrderApiController::class, 'store']);


// Example: /api/pages/privacy_policy
// Example: /api/pages/terms_conditions 
Route::get('/pages/{key}', [PageApiController::class, 'getPage']);
Route::post('/submit-ticket', [SupportTicketController::class, 'store']);


Route::get('/payments', [ApiPaymentController::class, 'index']);
Route::post('/payments', [ApiPaymentController::class, 'store']);

Route::get('/sliders', [SliderApiController::class, 'index']);


Route::get('/reports', [ReportApiController::class, 'index']);
