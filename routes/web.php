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
use App\Http\Controllers\Admin\BillDetailsController;
use App\Http\Controllers\Admin\BillDetailsRewardController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\ManageAppController;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Config and Cache Cleared!";
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
            Route::get('/edit', [UserController::class, 'edit'])->name('edit');
            Route::get('/view', [UserController::class, 'view'])->name('view');
        });

        // ✅ Subscriptions
        Route::prefix('subscription')->name('subscription.')->group(function () {
            Route::get('/', [SubscriptionController::class, 'index'])->name('index');
            Route::get('/create', [SubscriptionController::class, 'create'])->name('create');
            Route::get('/edit', [SubscriptionController::class, 'edit'])->name('edit');
            Route::get('/view', [SubscriptionController::class, 'view'])->name('view');
        });

        // ✅ Orders
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/view', [OrderController::class, 'view'])->name('view');
        });

        // ✅ Payments
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::get('/view', [PaymentController::class, 'view'])->name('view');

        });

        // ✅ Coupons
        Route::prefix('coupons')->name('coupons.')->group(function () {
            Route::get('/', [CouponController::class, 'index'])->name('index');
            Route::get('/create', [CouponController::class, 'create'])->name('create');
            Route::get('/edit', [CouponController::class, 'edit'])->name('edit');
            Route::get('/view', [CouponController::class, 'view'])->name('view');
        });

        // product
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::get('/edit', [ProductController::class, 'edit'])->name('edit');
            Route::get('/view', [ProductController::class, 'view'])->name('view');
        });

        // ✅ Bill Details
        Route::prefix('bill_details')->name('bill_details.')->group(function () {
            Route::get('/', [BillDetailsController::class, 'index'])->name('index');
            Route::get('/view', [BillDetailsController::class, 'view'])->name('view');
        });
        
                // ✅ Bill Details  reward
         Route::prefix('bill_reward')->name('bill_reward.')->group(function () {
            Route::get('/', [BillDetailsRewardController::class, 'index'])->name('index');
            Route::get('/view', [BillDetailsRewardController::class, 'view'])->name('view');
        });

        // ✅ Wallets
        Route::prefix('wallet')->name('wallet.')->group(function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('/view', [WalletController::class, 'view'])->name('view');
        });

        // ✅ reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
        });

        // ✅ supports
        Route::prefix('supports')->name('supports.')->group(function () {
            Route::get('/', [SupportController::class, 'index'])->name('index');
            Route::get('/view', [SupportController::class, 'view'])->name('view');
        });

        // ✅ manage app
        Route::prefix('manage_app')->name('manage_app.')->group(function () {
            Route::get('/sliders', [ManageAppController::class, 'sliders'])->name('sliders');
            Route::get('/pages', [ManageAppController::class, 'pages'])->name('pages');
            Route::get('/popup', [ManageAppController::class, 'popup'])->name('popup');
        });
    });
});
