<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/admin/profile', [BackendProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile', [BackendProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/change-password', [BackendProfileController::class, 'changePassword'])->name('admin.change.password');

    Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('reviews.all');
    Route::get('/admin/reviews/create', [ReviewController::class, 'create'])->name('review.add');
    Route::get('/admin/reviews/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::get('/admin/reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
    Route::post('/admin/reviews/store', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/admin/reviews/update', [ReviewController::class, 'update'])->name('review.update');

    Route::controller(SliderController::class)->group(function () {
        Route::get('/admin/slider/{id}', 'edit')->name('sliders.edit');
        Route::post('/admin/slider/update', 'update')->name('sliders.update');
    });
});

require __DIR__.'/auth.php';

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/verify-code', [AdminController::class, 'showVerification'])->name('custom.verification.form');
Route::post('/admin/verify-code', [AdminController::class, 'verifyCode'])->name('custom.verification.verify');
