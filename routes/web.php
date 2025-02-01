<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;

//home routes
//Route::get('/', [HomeController::class, 'index']);

// //admin routes
// Route::get('/admin-list', [AdminController::class, 'adminList'])->name('admin-list');
// //Route::get('/login', [AdminController::class, 'login'])->name('login');
// Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
// Route::get('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
// Route::get('/new-admin', [AdminController::class, 'newAdmin'])->name('new-admin');
// Route::get('/edit-profile', [AdminController::class, 'editProfile'])->name('edit-profile');

// //location routes
// Route::get('/location-detail', [LocationController::class, 'locationDetail'])->name('location-detail');

// //unit routes
// Route::get('/unit-list', [UnitController::class, 'unitList'])->name('unit-list');
// Route::get('/unit-detail', [UnitController::class, 'unitDetail'])->name('unit-detail');

// //customer routes
// Route::get('/customer-list', [CustomerController::class, 'customerList'])->name('customer-list');
// Route::get('/customer-detail', [CustomerController::class, 'customerDetail'])->name('customer-detail');

// //payment routes
// Route::get('/payment-list', [PaymentController::class, 'paymentList'])->name('payment-list');

// //review routes
// Route::get('/review-list', [ReviewController::class, 'reviewList'])->name('review-list');

Route::get('/about', [PageController::class, 'about']);
Route::get('/chart', [PageController::class, 'chart']);
Route::get('/tester', [PageController::class, 'tester'])->name('tester');

// Route::middleware('auth')->group(function () {
//     Route::get('/index', function () {
//         return view('index');
//     })->name('index');
// });

Route::middleware('auth')->group(function () {
    // Route::get('/', function () {
    //     return view('index');
    // })->name('index');

    //home route
    Route::get('/', [HomeController::class, 'index']);

    //admin routes
    Route::get('/admin-list', [AdminController::class, 'adminList'])->name('admin-list');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::get('/new-admin', [AdminController::class, 'newAdmin'])->name('new-admin');
    Route::get('/edit-profile', [AdminController::class, 'editProfile'])->name('edit-profile');
    Route::post('/edit-profile', [AdminController::class, 'editProfile'])->name('edit-profile');

    //location routes
    Route::get('/location-detail/{location_number?}', [LocationController::class, 'locationDetail'])->name('location-detail');
    Route::post('/set-activate-status', [LocationController::class, 'setActivateStatus'])->name('set-activate-status');

    //unit routes
    Route::get('/unit-list', [UnitController::class, 'unitList'])->name('unit-list');
    Route::get('/unit-detail/{unit_id?}', [UnitController::class, 'unitDetail'])->name('unit-detail');
    Route::post('/set-unit-activate-status', [UnitController::class, 'setActivateStatus'])->name('set-unit-activate-status');
    Route::post('/update-rent', [UnitController::class, 'updateRent'])->name('update-rent');

    //customer routes
    Route::get('/customer-list', [CustomerController::class, 'customerList'])->name('customer-list');
    Route::get('/customer-detail', [CustomerController::class, 'customerDetail'])->name('customer-detail');

    //payment routes
    Route::get('/payment-list', [PaymentController::class, 'paymentList'])->name('payment-list');

    //review routes
    Route::get('/review-list', [ReviewController::class, 'reviewList'])->name('review-list');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
});
