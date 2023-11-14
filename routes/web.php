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
Auth::routes();
// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('web')->middleware('web');

// Admin routes
Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::get('admin/register', [RegisterController::class, 'index'])->name('admine.register');
Route::post('admin/register', [RegisterController::class, 'create'])->name('admine.register');
// Route::get('admin/accounts', [RegisterController::class, 'show'])->name('admine.accounts');
Route::get('admin/accounts', [RegisterController::class, 'userlist'])->name('admine.accounts');

Route::get('admin/dossiers', [AdminController::class, 'dossiers'])->name('admine.dossiers');



Route::get('cadre/home', [CadreController::class, 'index'])->name('cadre.home');
Route::get('sg/home', [SgController::class, 'index'])->name('sg.home');
Route::get('chef/home', [ChefController::class, 'index'])->name('chef.home');

