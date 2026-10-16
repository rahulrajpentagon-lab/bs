<?php

use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Api\Admin\NotificationEmailController as AdminNotificationEmailController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EnquiryController;
use App\Http\Controllers\Api\WorksController;
use Illuminate\Support\Facades\Route;

Route::get('/company', [CompanyController::class, 'show']);
Route::get('/works', [WorksController::class, 'index']);
Route::post('/enquiries', [EnquiryController::class, 'store'])
    ->middleware('throttle:5,1');

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:10,1');

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/me', [AdminAuthController::class, 'me']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        Route::get('/enquiries', [AdminEnquiryController::class, 'index']);
        Route::get('/enquiries/{enquiry}', [AdminEnquiryController::class, 'show']);
        Route::put('/enquiries/{enquiry}', [AdminEnquiryController::class, 'update']);
        Route::delete('/enquiries/{enquiry}', [AdminEnquiryController::class, 'destroy']);

        Route::get('/notification-emails', [AdminNotificationEmailController::class, 'index']);
        Route::post('/notification-emails', [AdminNotificationEmailController::class, 'store']);
        Route::put('/notification-emails/{notificationEmail}', [AdminNotificationEmailController::class, 'update']);
        Route::delete('/notification-emails/{notificationEmail}', [AdminNotificationEmailController::class, 'destroy']);
    });
});
