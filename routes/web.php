<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/searchFood', [App\Http\Controllers\FoodController::class, 'search'])->name('searchFood');

Route::get('/addFood', function () {
    return view('addFood');
});

Route::post('/addFood/store', [App\Http\Controllers\FoodController::class,'add'])->name('addFood');

Route::get('/deleteFood/{id}', [App\Http\Controllers\FoodController::class,'delete'])->name('deleteFood');

Route::delete('/deleteSelectedFoods', [App\Http\Controllers\FoodController::class,'deleteSelectedFoods'])->name('deleteSelectedFoods');

Route::post('/selectAllFoods', [App\Http\Controllers\FoodController::class,'selectAllFoods'])->name('selectAllFoods');

Route::get('/selected', [App\Http\Controllers\FoodController::class,'selectAllFoods'])->name('selectAllFoods');

Route::get('/viewFood', [App\Http\Controllers\FoodController::class,'view'])->name('viewFood');

Route::get('/foodDetail/{id}', [App\Http\Controllers\FoodController::class,'edit'])->name('editFood');

Route::post('/updateFood', [App\Http\Controllers\FoodController::class,'update'])->name('updateFood');

Route::post('/searchProduct', [App\Http\Controllers\FoodController::class, 'searchProduct'])->name('searchProduct');


//mycart
Route::get('/showFood', [App\Http\Controllers\FoodController::class,'show'])->name('showFood');

Route::get('/myCart', [App\Http\Controllers\CartController::class, 'showMyCart'])->name('myCart');

Route::post('/addCart', [App\Http\Controllers\CartController::class, 'add'])->name('addCart');

Route::get('/deleteCart/{id}',[App\Http\Controllers\CartController::class,'delete'])->name('deleteCartItem');

Route::post('/update-quantity', [App\Http\Controllers\CartController::class,'updateQuantity'])->name('update.quantity');

Route::post('\checkout', [App\Http\Controllers\CartController::class, 'paymentPost'])->name('payment.post');

Route::get('/seeCheckOut', [App\Http\Controllers\CartController::class, 'showCheckout'])->name('myCheckOut');
