<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\Dashboard;

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('livewire.app');
})->name('dashboard');
Route::get('vattu/{MaVatTu}', [HomeController::class, 'show']);

