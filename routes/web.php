<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TacticController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tactics', TacticController::class);

Route::get('tactics/{tactic}/edit', [TacticController::class, 'edit'])->name('tactics.edit');
Route::post('tactics/{tactic}/update', [TacticController::class, 'update'])->name('tactics.update');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
