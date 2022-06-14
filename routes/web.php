<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('product.index');
// });

// Route::get('/product_create', function () {
//     return view('product.create');
// });

// Route::get('/product_update', function () {
//     return view('product.update');
// });

Route::get('/product_create', [ProductController::class ,"CreatePage"]);

Route::post('/product_create', [ProductController::class ,"Create"]);

Route::post('/product_delete', [ProductController::class ,"Delete"]);

Route::get('/product_update/{product_id}', [ProductController::class ,"UpdatePage"])->name('product_update');

Route::post('/product_update', [ProductController::class ,"Update"]);

Route::get('/{lang}', [ProductController::class ,"Index"]);
Route::get('/', [ProductController::class ,"Index"]);
