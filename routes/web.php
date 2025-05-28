<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Livewire\Dashboard;
use App\Http\Controllers\Auth\CreateAccountController;
use App\Http\Controllers\ProfileController;

//php artisan make:middleware IsAdmin

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/dashboard', function () {
    return view('livewire.app');
})->name('dashboard')->middleware('auth')->middleware('IsAdmin');
//auth: ktra người dùng đã đăng nhập.
//middleware chỉ ng có vai trò admin.
Route::get('/product/{MaVatTu}', [DetailController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);

Route::get('/reset/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset');
Route::post('/reset/{token}', [ForgotPasswordController::class, 'resetPasswordSubmit']);

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

