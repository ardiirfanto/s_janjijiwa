<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KataDihilangkanController;
use App\Http\Controllers\TestingDetilController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Master Data
    Route::prefix('data')->group(function () {
        Route::prefix('training')->group(function () {
            Route::get('/', [TrainingController::class, 'index'])->name('data.training');
            Route::post('store', [TrainingController::class, 'store'])->name('data.training.store');
            Route::post('import', [TrainingController::class, 'import'])->name('data.training.import');
            Route::get('clear', [TrainingController::class, 'clear'])->name('data.training.clear');
            Route::get('delete/{id}', [TrainingController::class, 'delete'])->name('data.training.delete');
        });
        Route::prefix('stopwords')->group(function () {
            Route::get('/', [KataDihilangkanController::class, 'index'])->name('data.stopwords');
            Route::post('store', [KataDihilangkanController::class, 'store'])->name('data.stopwords.store');
            Route::post('import', [KataDihilangkanController::class, 'import'])->name('data.stopwords.import');
            Route::get('clear', [KataDihilangkanController::class, 'clear'])->name('data.stopwords.clear');
            Route::get('delete/{id}', [KataDihilangkanController::class, 'delete'])->name('data.stopwords.delete');
        });
    });

    Route::prefix('uji')->group(function () {

    });

    Route::get('tes',[TestingDetilController::class,'getdata']);

    // Last
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
