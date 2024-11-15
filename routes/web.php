<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AjouterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JControllerCategories;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Routes publiques (accessibles à tous)
Route::get('/', [JControllerCategories::class, 'index']);
Route::get('/find-category-id', [JControllerCategories::class, 'findCategoryId'])->name('findCategoryId');
Route::get('/categorie/{id}', [JControllerCategories::class, 'show'])->name('categoryProducts');
Route::resource('categorie', JControllerCategories::class);
Route::get('/navbar', function() {
    return view('navbar');
});

// Routes d'authentification
Auth::routes();
Route::post('/logoutx', [LoginController::class, 'logoutx'])->name('logoutx');

// Routes pour tous les utilisateurs authentifiés (client, admin, super_admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Gestion du profil (accessible à tous les utilisateurs connectés)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Routes pour admin et super_admin uniquement
Route::middleware(['auth','role:admin,super_admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des produits
    Route::resource('products', ProductController::class);
    
    // Gestion des catégories
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/{id}/products', [CategoryController::class, 'showProducts'])->name('categories.products');
});

// Routes exclusives au super_admin
Route::middleware(['auth','role:super_admin'])->group(function () {
    // Gestion des utilisateurs
    Route::get('/users', [UserController::class, 'users'])->name('users.index');
    // Ajout des routes CRUD pour la gestion des utilisateurs
    Route::get('/users/create', [UserController::class, 'add'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('roles', RoleController::class);
});

