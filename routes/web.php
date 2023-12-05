<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CadreController;
use App\Http\Controllers\SgController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\FichierController;
use App\Http\Middleware\CheckAdminRole;

// Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('web');
// Route::get('/register', [RegisterController::class, 'index']);
// Route::post('/register', [RegisterController::class, 'create'])->name('register');
 Auth::routes();







// Cadre Routes
Route::prefix('cadre')->group(function () {
    Route::get('/home', [FichierController::class, 'index'])->name('cadre.home');
    Route::get('/create', [FichierController::class, 'create'])->name('cadre.create');
    Route::post('/create', [FichierController::class, 'store'])->name('fichiers.store');
    Route::delete('/{id}', [FichierController::class, 'destroy'])->name('fichiers.destroy');
    Route::get('/{id}/edit', [FichierController::class, 'edit'])->name('fichiers.edit');
    Route::patch('/{id}', [FichierController::class, 'update'])->name('fichiers.update');
    Route::post('/search', [FichierController::class, 'search'])->name('fichiers.search');
    Route::get('/category/{categoryId}', [FichierController::class, 'filteredByCategory'])->name('fichiers.filteredByCategory');
    Route::get('/division/{division}', [FichierController::class, 'filteredByDivision'])->name('fichiers.filteredByDivision');
});


// Admin Routes
Route::prefix('admin')->group(function () {

    Route::get('/register', [RegisterController::class, 'index'])->name('admine.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('admine.register');
    Route::get('/rechecher', [AdminController::class, 'searchByName'])->name('admine.searchByName');
    Route::get('/modify/{id}', [AdminController::class, 'showModifyForm'])->name('admine.modify');
    Route::put('/modify/{id}', [AdminController::class, 'modify'])->name('admine.modifye');
    Route::get('/daleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admine.deleteUser');

    Route::get('/users', [AdminController::class, 'listAcc'])->name('admine.accounts');
    Route::get('/dossiers', [AdminController::class, 'dossiers'])->name('admine.dossiers');
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/archife', [AdminController::class, 'archife'])->name('admine.archife');
    Route::get('/create', [AdminController::class, 'create'])->name('admine.create');
    Route::post('/create', [AdminController::class, 'store'])->name('admine.store');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admine.destroy');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admine.edit');
    Route::patch('/{id}', [AdminController::class, 'update'])->name('admine.update');
    Route::patch('/search', [AdminController::class, 'search'])->name('admine.search');
    Route::get('/category/{categoryId}', [AdminController::class, 'filteredByCategory'])->name('admine.filteredByCategory');
    Route::get('/division/{division}', [AdminController::class, 'filteredByDivision'])->name('admine.filteredByDivision');
});
// Sg Routes
Route::prefix('sg')->group(function () {
    Route::get('/home', [SgController::class, 'index'])->name('sg.home');

});

// Chef Routes
Route::prefix('chef')->group(function () {
    Route::get('/home', [ChefController::class, 'index'])->name('chef.home');
    Route::get('/category/{categoryId}', [ChefController::class, 'filteredByCategory'])->name('chef.filteredByCategory');
    Route::post('/search', [ChefController::class, 'search'])->name('chef.search');
});

