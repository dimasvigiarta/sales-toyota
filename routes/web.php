<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\SalesContactController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/mobil', [FrontController::class, 'carIndex'])->name('cars.index');
Route::get('/mobil/{slug}', [FrontController::class, 'carShow'])->name('cars.show');
Route::get('/promo', [FrontController::class, 'promoIndex'])->name('promos.index');
Route::get('/promo/{slug}', [FrontController::class, 'promoShow'])->name('promos.show');
Route::get('/api/sales-contacts', [FrontController::class, 'salesContacts'])->name('api.sales-contacts');
Route::get('/tentang-kami', [FrontController::class, 'tentang'])->name('tentang');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('cars', CarController::class);
    Route::post('cars/{car}/images', [CarController::class, 'uploadImages'])->name('cars.images.upload');
    Route::post('cars/{car}/highlights/image', [CarController::class, 'uploadHighlightImage'])
     ->name('cars.highlights.image');
    Route::delete('cars/images/{image}', [CarController::class, 'deleteImage'])->name('cars.images.delete');

    Route::resource('promos', PromoController::class);
    Route::resource('contacts', SalesContactController::class);
});