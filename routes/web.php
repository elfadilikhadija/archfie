<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CadreController;
use App\Http\Controllers\SgController;
use App\Http\Controllers\ChefController;

use App\Http\Controllers\Auth\RegisterController;

// Your existing routes...

// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'creat'])->name('register');
Auth::routes();
// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('web')->middleware('web');

// Admin routes
Route::get('admin/home', [AdminController::class, 'index'])->name('admine.home');
Route::get('cadre/home', [CadreController::class, 'index'])->name('cadre.home');
Route::get('sg/home', [SgController::class, 'index'])->name('sg.home');
Route::get('chef/home', [ChefController::class, 'index'])->name('chef.home');

