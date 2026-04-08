<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ClarifiesController;
use App\Http\Controllers\Backend\FeaturesController;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\UsabilityController;
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
        Route::get('/admin/slider/edit/{id}', 'edit')->name('sliders.edit');
        Route::post('/admin/slider/update', 'update')->name('sliders.update');
    });

    Route::controller(FeaturesController::class)->group(function () {
        Route::get('/admin/features', 'index')->name('features.all');
        Route::get('/admin/features/edit/{id}',  'edit')->name('features.edit');
        Route::get('/admin/features/create', 'create')->name('features.add');
        Route::get('/admin/features/delete/{id}', 'destroy')->name('features.delete');
        Route::post('/admin/features/store', 'store')->name('feature.store');
        Route::post('/admin/features/update', 'update')->name('feature.update');
    });

    Route::controller(ClarifiesController::class)->group(function () {
        Route::get('/admin/clarifies', 'index')->name('clarifies.all');
        Route::get('/admin/clarifies/edit/{id}', 'edit')->name('clarifies.edit');
        Route::get('/admin/clarifies/create', 'create')->name('clarifies.add');
        Route::post('/admin/clarifies/store', 'store')->name('clarifies.store');
        Route::post('/admin/clarifies/update', 'update')->name('clarifies.update');
        Route::get('/admin/clarifies/delete/{id}', 'destroy')->name('clarifies.delete');
    });


    Route::controller(UsabilityController::class)->group(function () {
        Route::get('/admin/usabilities', 'index')->name('usabilities.index');
        Route::get('/admin/usabilities/edit/{id}', 'edit')->name('usabilities.edit');
        Route::get('/admin/usabilities/create', 'create')->name('usabilities.create');
        Route::post('/admin/usabilities/store', 'store')->name('usabilities.store');
        Route::post('/admin/usabilities/update', 'update')->name('usabilities.update');
        Route::get('/admin/usabilities/delete/{id}', 'destroy')->name('usabilities.destroy');
    });

});

require __DIR__.'/auth.php';

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/verify-code', [AdminController::class, 'showVerification'])->name('custom.verification.form');
Route::post('/admin/verify-code', [AdminController::class, 'verifyCode'])->name('custom.verification.verify');
