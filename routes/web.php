<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');   
});

Route::get('user/list', [UserController::class,'list'])->name('user.list');
Route::get('user/insert', [UserController::class,'insert'])->name('user.insert');
Route::post('user/create', [UserController::class,'create'])->name('user.create');
Route::get('user/destroy/{id}', [UserController::class,'destroy'])->name('user.destroy');
Route::get('user/edit/{id}', [UserController::class,'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/bulk-delete', [UserController::class, 'bulkDelete'])->name('user.bulkDelete');

Route::get('category/list',[CategoryController::class,'list'])->name('category.list');
Route::get('category/insert',[CategoryController::class,'insert'])->name('category.insert');
Route::post('category/create', [CategoryController::class,'create'])->name('category.create');
Route::get('category/destroy/{id}', [CategoryController::class,'destroy'])->name('category.destroy');
Route::get('category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('category.bulkDelete');