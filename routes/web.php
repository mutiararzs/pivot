<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tes', [AssessmentController::class, 'info'])->name('tes.info');
    Route::post('/tes/mulai', [AssessmentController::class, 'start'])->name('tes.mulai');
    Route::get('/tes/{assessment}/soal/{no}', [AssessmentController::class, 'show'])
        ->whereNumber('no')->name('tes.soal');
    Route::post('/tes/{assessment}/soal/{no}', [AssessmentController::class, 'answer'])
        ->whereNumber('no')->name('tes.jawab');
    Route::get('/tes/{assessment}/hasil', [AssessmentController::class, 'hasil'])->name('tes.hasil');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';