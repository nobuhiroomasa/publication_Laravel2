<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReservationController::class, 'showPublicPage'])->name('home');
Route::get('/menu', [ReservationController::class, 'showPublicPage'])->name('menu');
Route::get('/access', [ReservationController::class, 'showPublicPage'])->name('access');
Route::get('/contact', [ReservationController::class, 'showPublicPage'])->name('contact');
Route::get('/reserve', [ReservationController::class, 'showPublicPage'])->name('reserve');
Route::get('/reserve/complete', [ReservationController::class, 'complete'])->name('reserve.complete');
Route::get('/gallery', [ReservationController::class, 'showPublicPage'])->name('gallery');

Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'adminIndex'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'adminShow'])->name('reservations.show');
    Route::patch('/reservations/{reservation}', [ReservationController::class, 'updateStatus'])->name('reservations.update');
});
