<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\PartnerController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kategori', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::post('/pesanan', [OrderController::class, 'store'])->name('orders.store');

Route::get('/pesanan/sukses/{orderNumber}', [OrderController::class, 'success'])
   ->name('orders.success');

Route::middleware('guest')->group(function() {
   Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
   Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
   ->name('logout')
   ->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
   Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
   
   Route::resource('categories', 
    \App\Http\Controllers\Admin\CategoryController::class);
   
   Route::resource('products', ProductController::class)->except(['show']);
   
   Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
   
   Route::resource('settings', SettingController::class)->only(['index', 'update']);

   Route::resource('testimonials', TestimonialController::class)
      ->only(['index', 'update', 'destroy'])
      ->names('testimonials');

   Route::resource('galleries', GalleryController::class)->except(['show']);
   
   Route::resource('facilities', FacilityController::class)->except(['show', 'create', 'edit']);
   
   Route::resource('partners', PartnerController::class)->except(['show', 'create', 'edit']);
});

Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');

Route::get('/lacak', [OrderController::class, 'track'])->name('orders.track');