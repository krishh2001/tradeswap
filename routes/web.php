<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\EditProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BillCashbackController;
use App\Http\Controllers\Admin\BillRewardController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\ManageAppController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WithdrawRequestController;




use Illuminate\Support\Facades\Artisan;

Route::get('/clear', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Config and Cache Cleared!";
});

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return '✅ Migration executed successfully!';
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Login Routes
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('auth:admin')->group(function () {

        // ✅ Profile Management
        Route::get('/edit-profile', [EditProfileController::class, 'edit'])->name('profile.edit');


        // ✅ Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // ✅ User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/view/{user}', [UserController::class, 'view'])->name('view');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggleStatus');
        });


        // ✅ Subscriptions
        Route::prefix('subscription')->name('subscription.')->group(function () {
            Route::get('/', [SubscriptionController::class, 'index'])->name('index');
            Route::get('/create', [SubscriptionController::class, 'create'])->name('create');
            Route::post('/', [SubscriptionController::class, 'store'])->name('store');
            Route::get('/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('edit');
            Route::put('/{subscription}', [SubscriptionController::class, 'update'])->name('update');
            Route::get('/{subscription}', [SubscriptionController::class, 'view'])->name('view');
            Route::delete('/{subscription}', [SubscriptionController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('withdraw_request')->name('withdraw_request.')->group(function () {
              Route::get('/', [WithdrawRequestController::class, 'index'])->name('index');
    Route::get('/{id}/view', [WithdrawRequestController::class, 'view'])->name('view');
    Route::post('/{id}/toggle-status', [WithdrawRequestController::class, 'toggleStatus'])->name('toggle');
    Route::delete('/{id}', [WithdrawRequestController::class, 'destroy'])->name('destroy');

        });



        // ✅ Orders
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/view/{id}', [OrderController::class, 'view'])->name('view');
            Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
        });

        // ✅ Payments
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::get('view/{id}', [PaymentController::class, 'view'])->name('view');
            Route::delete('{id}', [PaymentController::class, 'destroy'])->name('destroy');
        });

        // ✅ Coupons
        Route::prefix('coupons')->name('coupons.')->group(function () {
            Route::get('/', [CouponController::class, 'index'])->name('index');
            Route::get('/create', [CouponController::class, 'create'])->name('create');
            Route::post('/', [CouponController::class, 'store'])->name('store');
            Route::get('/{coupon}/edit', [CouponController::class, 'edit'])->name('edit');
            Route::put('/{coupon}', [CouponController::class, 'update'])->name('update');
            Route::delete('/{coupon}', [CouponController::class, 'destroy'])->name('destroy');
            Route::get('/{coupon}/view', [CouponController::class, 'view'])->name('view');
            Route::post('/{coupon}/toggle-status', [CouponController::class, 'toggleStatus'])->name('toggle-status');
        });


        // ✅ Product Management 
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}', [ProductController::class, 'show'])->name('show');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
            Route::patch('/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('toggleStatus');
        });


        // ✅ Bill Details
        Route::prefix('bill-cashback')->name('bill_cashback.')->group(function () {
            Route::get('/', [BillCashbackController::class, 'index'])->name('index');
            Route::get('/view/{id}', [BillCashbackController::class, 'view'])->name('view');
            Route::post('/approve/{id}', [BillCashbackController::class, 'approveCashback']);
            Route::post('/discard/{id}', [BillCashbackController::class, 'discardCashback']);
            Route::delete('/delete/{id}', [BillCashbackController::class, 'destroy']);
        });


        // ✅ Bill Details reward
        Route::prefix('bill-reward')->name('bill_reward.')->group(function () {
            Route::get('/', [BillRewardController::class, 'index'])->name('index');
            Route::get('{id}', [BillRewardController::class, 'show'])->name('view');
            Route::post('{id}/approve', [BillRewardController::class, 'approve'])->name('approve');
            Route::post('{id}/discard', [BillRewardController::class, 'discard'])->name('discard');
            Route::delete('{id}', [BillRewardController::class, 'destroy'])->name('delete');
        });


        // ✅ Wallets
        Route::prefix('wallet')->name('wallet.')->group(function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('/{id}', [WalletController::class, 'show'])->name('view');
            Route::patch('/toggle-status/{id}', [WalletController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/{id}', [WalletController::class, 'destroy'])->name('delete');
        });


        // ✅ reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::delete('{report}', [ReportController::class, 'destroy'])->name('destroy');
        });


        // ✅ supports
        Route::prefix('supports')->name('supports.')->group(function () {
            Route::get('/', [SupportController::class, 'index'])->name('index');
            Route::post('/{ticket}/reply', [SupportController::class, 'reply'])->name('reply');
            Route::post('/{ticket}/toggle-status', [SupportController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/{ticket}', [SupportController::class, 'destroy'])->name('delete');
        });


        // Manage App Pages and Popups
        Route::prefix('manage_app')->name('manage_app.')->group(function () {
            Route::get('/pages', [ManageAppController::class, 'pages'])->name('pages');
            Route::post('/pages', [ManageAppController::class, 'updatePages'])->name('pages.update');
            Route::get('/popup', [ManageAppController::class, 'popup'])->name('popup');

            // ✅ SLIDER ROUTES
            Route::get('sliders', [SliderController::class, 'index'])->name('sliders');
            Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store');
            Route::put('sliders/{slider}', [SliderController::class, 'update'])->name('sliders.update');
            Route::delete('sliders/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
            Route::post('sliders/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('sliders.toggle');
        });
    });
});
