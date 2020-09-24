<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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
Route::get('/index',function(){
    return view('index');
});
Route::get('/home',[PageController::class,'show_product'])->name('home');
Route::get('/category/{cate}',[PageController::class,'showProductByCategory'])->name('show.category');
Route::get('/admin/signIn',function(){
    return view('sign_in');
});
// Route::get('/detail',[PageController::class,'show_detail']);
Route::get('/product/detail/{id}',[PageController::class,'show_detail'])->name('product.detail');
Route::get('/checkout/{id}',[PageController::class,'checkout'])->name('product.checkout');
Route::get('/cart',[PageController::class,'cart']);
Route::post('checkout',[PageController::class,'checkout_store'])->name('checkout.store');
Route::get('/add-to-cart/{id}',[PageController::class, 'addToCart']);
Route::get('/test-cart',[PageController::class,'testCart']);
Route::delete('/remove/{id}',[PageController::class,'removeCart'])->name('removeCart');

