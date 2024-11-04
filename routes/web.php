<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ProductController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\ajouterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JControllerCategories;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [JControllerCategories::class, 'index']);

Route::get('/find-category-id', [JControllerCategories::class, 'findCategoryId'])->name('findCategoryId');


Route::post('/logoutx', [LoginController::class, 'logoutx'])->name('logoutx');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//  Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

//  Route::get('/categories/{id}', [categoryController::class, 'show'])->name('categories.show');


//  Route::get('/categorie/{id}', [JControllerCategories::class, 'show'])->name('categoryProducts');


Route::resource('products', ProductController::class);

Route::resource('categories', categoryController::class);

Route::resource('categorie', JControllerCategories::class);




Route::get('/categories/{id}/products', [CategoryController::class, 'showProducts'])->name('categories.products');
Route::get('/navbar',function(){
    return view('navbar');
});