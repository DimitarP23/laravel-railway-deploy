<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MyStockController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Test route for 500 error
Route::get('/test-500', function () {
    throw new Exception('Test exception for 500 error page');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])
        ->middleware('throttle:7,1')
        ->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('throttle:7,1');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Protected routes here
    Route::get('/contact', [ContactController::class, 'show']);
    Route::post('/contact', [ContactController::class, 'submit']);

    // Stocks route - shows hot stocks
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks');

    // My Stocks management routes - for user's personal stock portfolio
    Route::resource('my-stocks', MyStockController::class, [
        'names' => [
            'index' => 'my-stocks.index',
            'create' => 'my-stocks.create',
            'store' => 'my-stocks.store',
            'show' => 'my-stocks.show',
            'edit' => 'my-stocks.edit',
            'update' => 'my-stocks.update',
            'destroy' => 'my-stocks.destroy',
        ]
    ]);
});
