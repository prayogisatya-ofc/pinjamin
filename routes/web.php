<?php

use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\LoadSettings;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::prefix('panel')
    ->name('panel.')
    ->middleware([LoadSettings::class, 'auth', AdminOnly::class])
    ->group(function () {

        //Route Kategori
        Route::resource('categories', CategoryController::class)
            ->names('categories')
            ->except('create', 'show', 'edit');

        //Route Buku
        Route::resource('books', BookController::class)
            ->names('books');
    });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
