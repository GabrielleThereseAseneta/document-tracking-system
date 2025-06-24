<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeeklyMailingController;
use App\Http\Controllers\SpecialOrderController;
use App\Http\Controllers\MemorandumController;
use App\Http\Controllers\AdvisoryController;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Other resources (Weekly Mailing, Special Order, Memorandum, Advisory)
Route::resource('weeklymailing', WeeklyMailingController::class)->except(['show']);
Route::resource('specialorder', SpecialOrderController::class)->except(['show']);
Route::resource('memorandum', MemorandumController::class)->except(['show']);
Route::resource('advisory', AdvisoryController::class)->except(['show']);

// Optional: Fallback for 404s
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
