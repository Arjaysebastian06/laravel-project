<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;

// Home page
Route::get('/', function () {
    return view('example');
});

// Login page & function
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard showing all users
Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

// Add user (from modal)
Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');

// Update & Delete user
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Reload captcha
Route::get('/reload-captcha', function () {
    return captcha_img('math');
});

//This route called the fuction of store to validate or saving the data in the database 
Route::post('/', [RegisterController::class, 'store']);