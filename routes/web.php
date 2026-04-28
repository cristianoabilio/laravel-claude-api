<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AnswerController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\ClarifiesController;
use App\Http\Controllers\Backend\ConnectController;
use App\Http\Controllers\Backend\FeaturesController;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TeamController;
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

    Route::controller(ConnectController::class)->group(function () {
        Route::get('/admin/connects', 'index')->name('connects.index');
        Route::get('/admin/connects/edit/{id}', 'edit')->name('connects.edit');
        Route::get('/admin/connects/create', 'create')->name('connects.create');
        Route::post('/admin/connects/store', 'store')->name('connects.store');
        Route::post('/admin/connects/update', 'update')->name('connects.update');
        Route::get('/admin/connects/delete/{id}', 'destroy')->name('connects.destroy');
    });

    Route::controller(AnswerController::class)->group(function () {
        Route::get('/admin/faqs', 'index')->name('faqs.index');
        Route::get('/admin/faqs/edit/{id}', 'edit')->name('faqs.edit');
        Route::get('/admin/faqs/create', 'create')->name('faqs.create');
        Route::post('/admin/faqs/store', 'store')->name('faqs.store');
        Route::post('/admin/faqs/update', 'update')->name('faqs.update');
        Route::get('/admin/faqs/delete/{id}', 'destroy')->name('faqs.destroy');
    });

    Route::controller(TeamController::class)->group(function () {
        Route::get('/admin/team', 'index')->name('team.index');
        Route::get('/admin/team/edit/{id}', 'edit')->name('team.edit');
        Route::get('/admin/team/create', 'create')->name('team.create');
        Route::post('/admin/team/store', 'store')->name('team.store');
        Route::post('/admin/team/update', 'update')->name('team.update');
        Route::get('/admin/team/delete/{id}', 'destroy')->name('team.destroy');
    });

    Route::controller(AboutController::class)->group(function () {
        Route::get('/admin/about-us', 'index')->name('about.index');
        Route::post('/admin/about-us/update', 'update')->name('about.update');
    });

    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('/admin/blog-category', 'index')->name('blog-category.index');
        Route::get('/admin/blog-category/edit/{id}', 'edit')->name('blog-category.edit');
        Route::get('/admin/blog-category/create', 'create')->name('blog-category.create');
        Route::post('/admin/blog-category/store', 'store')->name('blog-category.store');
        Route::post('/admin/blog-category/update', 'update')->name('blog-category.update');
        Route::get('/admin/blog-category/delete/{id}', 'destroy')->name('blog-category.destroy');
    });

});

require __DIR__.'/auth.php';

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/verify-code', [AdminController::class, 'showVerification'])->name('custom.verification.form');
Route::post('/admin/verify-code', [AdminController::class, 'verifyCode'])->name('custom.verification.verify');
