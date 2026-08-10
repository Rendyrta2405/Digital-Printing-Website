<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Models\Category;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kategori', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('categories.show');