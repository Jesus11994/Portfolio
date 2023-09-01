<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PorfolioController;
use App\Http\Controllers\Admin\MailUseController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('', [AdminController::class,'index'])->name('admin.index');
    Route::get('/Porfolio', [PorfolioController::class,'index'])->name('porfo.index');
    Route::get('/Email', [MailUseController::class,'index'])->name('email.index');
});