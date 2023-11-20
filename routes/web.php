<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CadreController;
use App\Http\Controllers\SgController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\FichierController;

use App\Http\Controllers\Auth\RegisterController;

// Your existing routes...
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'create'])->name('register');



// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('web')->middleware('web');
Auth::routes();
// Admin routes
Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::get('admin/register', [RegisterController::class, 'index'])->name('admine.register');
Route::post('admin/register', [RegisterController::class, 'create'])->name('admine.register');
// Route::get('admin/accounts', [RegisterController::class, 'show'])->name('admine.accounts');
Route::get('admin/accounts', [RegisterController::class, 'userlist'])->name('admine.accounts');

Route::get('admin/dossiers', [AdminController::class, 'dossiers'])->name('admine.dossiers');



Route::get('cadre/home', [FichierController::class, 'index'])->name('cadre.home');
Route::get('cadre/create', [FichierController::class, 'create'])->name('cadre.create');
Route::post('cadre/create', [FichierController::class, 'store'])->name('fichiers.store');
Route::delete('/cadre/{id}', [FichierController::class, 'destroy'])->name('fichiers.destroy');
Route::get('/cadre/{id}/edit', [FichierController::class, 'edit'])->name('fichiers.edit');
Route::patch('/cadre/{id}', [FichierController::class, 'update'])->name('fichiers.update');
Route::post('/cadre/search', [FichierController::class, 'search'])->name('fichiers.search');
Route::get('/cadre/category/{categoryId}', [FichierController::class, 'filteredByCategory'])->name('fichiers.filteredByCategory');
Route::get('/cadre/division/{division}', [FichierController::class, 'filteredByDivision'])->name('fichiers.filteredByDivision');

Route::get('sg/home', [SgController::class, 'index'])->name('sg.home');
Route::get('chef/home', [ChefController::class, 'index'])->name('chef.home');

