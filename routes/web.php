<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');   

    Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
        Route::get('list', 'list')->name('list');
        Route::get('insert', 'insert')->name('insert');
        Route::post('create', 'create')->name('create');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('{id}', 'update')->name('update');
        Route::delete('bulk-delete', 'bulkDelete')->name('bulkDelete');
    });
    
    Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
        Route::get('list', 'list')->name('list');
        Route::get('insert', 'insert')->name('insert');
        Route::post('create', 'create')->name('create');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('{id}', 'update')->name('update');
        Route::delete('bulk-delete', 'bulkDelete')->name('bulkDelete');
    });
   
    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        Route::get('list', 'list')->name('list');
        Route::get('insert', 'insert')->name('insert');
        Route::post('create', 'create')->name('create');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('{id}', 'update')->name('update');
        Route::delete('bulk-delete', 'bulkDelete')->name('bulkDelete');
    });
});



