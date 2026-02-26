<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dompet/keuangan', [TransactionController::class, 'index'])->name('dompet.index');
    Route::post('/dompet/keuangan', [TransactionController::class, 'store'])->name('dompet.store');
    Route::get('/dompet/riwayat', [TransactionController::class, 'allHistory'])->name('dompet.riwayat');

    // Savings / Wishlist
    Route::get('/dompet/tabungan', [\App\Http\Controllers\SavingController::class, 'index'])->name('savings.index');
    Route::post('/dompet/tabungan', [\App\Http\Controllers\SavingController::class, 'store'])->name('savings.store');
    Route::post('/dompet/tabungan/{saving}/add-funds', [\App\Http\Controllers\SavingController::class, 'addFunds'])->name('savings.addFunds');
    Route::delete('/dompet/tabungan/{saving}', [\App\Http\Controllers\SavingController::class, 'destroy'])->name('savings.destroy');

    // Journey Map
    Route::get('/journey', [\App\Http\Controllers\JourneyController::class, 'index'])->name('journey.index');
    Route::post('/journey', [\App\Http\Controllers\JourneyController::class, 'store'])->name('journey.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
