<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('portfolio')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
    Route::get('{id}', [PortfolioController::class, 'show'])->name('portfolio.show');
});

Route::get('contact', [ContactController::class, 'index'])->name('contact');

require __DIR__.'/settings.php';
