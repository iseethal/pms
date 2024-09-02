<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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

Route::get('/', function () {
    return view('template');
});

Route::resource('project', ProjectController::class);
Route::get('/delete-project/{id}',[ProjectController::class,'DeleteProject'])->name('project.destroy');

Route::resource('task', TaskController::class);
Route::get('/delete-task/{id}',[TaskController::class,'DeleteTask'])->name('task.destroy');


Route::get('time',[TaskController::class,'Time'])->name('time');
Route::get('report',[ProjectController::class,'Report'])->name('report');

Route::resource('category', CategoryController::class);
Route::resource('sub-category', SubCategoryController::class);
Route::resource('product', ProductController::class);

Route::get('/get-subcategories/{categoryId}',[ProductController::class,'GetSubCategories']);
Route::get('/all-products',[ProductController::class,'AllProducts'])->name('all-products');
Route::post('/add-to-cart/{id}',[ProductController::class,'AddToCart'])->name('add-to-cart');
Route::get('/cart',[ProductController::class,'Cart'])->name('cart');
Route::get('/cart/count', [ProductController::class, 'GetCartCount'])->name('cart.count');
Route::post('/update-cart/{id}',[ProductController::class,'UpdateCart'])->name('update-cart');
Route::get('/add-image',[ProductController::class,'AddImage'])->name('add-image');
Route::post('/store-image',[ProductController::class,'StoreImage'])->name('image.store');
