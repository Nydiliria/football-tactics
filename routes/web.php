<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TacticController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('tactics', [TacticController::class, 'index'])->name('tactics.index');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('tactics/create', [TacticController::class, 'create'])->name('tactics.create');
    Route::post('tactics', [TacticController::class, 'store'])->name('tactics.store');
    Route::get('tactics/{tactic}/edit', [TacticController::class, 'edit'])->name('tactics.edit');
    Route::patch('tactics/{tactic}', [TacticController::class, 'update'])->name('tactics.update');
    Route::delete('tactics/{tactic}', [TacticController::class, 'destroy'])->name('tactics.destroy');
});

Route::get('tactics/{tactic}', [TacticController::class, 'show'])->name('tactics.show');

// Admin-only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/tactics', [TacticController::class, 'adminIndex'])->name('admin.tactics.index');
    Route::post('admin/tactics/{tactic}/approve', [TacticController::class, 'approve'])
        ->name('admin.tactics.approve');

    Route::resource('categories', CategoryController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth routes
require __DIR__ . '/auth.php';
