<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KataDihilangkanController;
use App\Http\Controllers\TestingController;
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
        Route::prefix('testing')->group(function () {
            Route::get('/', [TestingController::class, 'index'])->name('uji.testing');
            Route::post('store', [TestingController::class, 'store'])->name('uji.testing.store');
            Route::post('update', [TestingController::class, 'update'])->name('uji.testing.update');
            Route::get('delete/{id}', [TestingController::class, 'delete'])->name('uji.testing.delete');
            Route::prefix('detail')->group(function () {
                Route::get('view/{testing_id}', [TestingDetilController::class, 'view'])->name('uji.testing.detail.view');
                Route::post('get', [TestingDetilController::class, 'get'])->name('uji.testing.detail.get');
                Route::get('clear/{testing_id}', [TestingDetilController::class, 'clear'])->name('uji.testing.detail.clear');
            });
        });

        Route::prefix('proses')->group(function () {
            Route::get('/', [HasilController::class, 'index'])->name('uji.proses');
            Route::post('view', [HasilController::class, 'view'])->name('uji.proses.view');
            Route::get('proses/{testing_id}', [HasilController::class, 'proses'])->name('uji.proses.proses');
        });
    });

    Route::get('tes', [TestingDetilController::class, 'getdata']);

    // Last
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
