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
use App\Http\Controllers\Api\LoginController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);


Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);

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
