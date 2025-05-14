<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Livewire\Dashboard;

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('livewire.app');
})->name('dashboard');
Route::get('/{MaVatTu}', [DetailController::class, 'index']);

