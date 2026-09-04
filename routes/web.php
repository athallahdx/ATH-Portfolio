<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('portfolios')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
    Route::get('/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
});

Route::prefix('works')->group(function () {
    Route::get('/', [WorkController::class, 'index'])->name('work');
    Route::get('/{portfolio:slug}', [WorkController::class, 'show'])->name('work.show');
});

Route::get('contact', [ContactController::class, 'index'])->name('contact');

