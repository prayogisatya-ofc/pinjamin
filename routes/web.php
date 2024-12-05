<?php

use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\LoadSettings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\RenterController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\RentingController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::prefix('panel')
    ->name('panel.')
    ->middleware([LoadSettings::class, 'auth', AdminOnly::class])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        //Route Kategori
        Route::resource('categories', CategoryController::class)
            ->names('categories')
            ->except('create', 'show', 'edit');

        //Route Buku
        Route::resource('books', BookController::class)
            ->names('books');

        //Route Peminjam
        Route::resource('renters', RenterController::class)
            ->names('renters')
            ->except('store', 'edit');

        //Route Admin
        Route::resource('admins', AdminController::class)
            ->names('admins')
            ->except('show');

        //Route Log Peminjaman
        Route::resource('rentings', RentingController::class)
            ->names('rentings')
            ->only('index', 'show', 'destroy');
        Route::post('rentings/download', [RentingController::class, 'download'])->name('rentings.download');
        Route::get('rentings/download/pdf', [RentingController::class, 'pdf'])->name('rentings.pdf');

        //Route Pengembalian
        Route::resource('returns', ReturnController::class)
            ->names('returns')
            ->only('index', 'update');
        Route::put('returns/{return}/update-lost', [ReturnController::class, 'updateLost'])->name('returns.update-lost');

        Route::resource('settings', SettingController::class)
            ->names('settings')
            ->only('index', 'store');
    });

Route::get('/', [HomeController::class, 'index'])->name('home');