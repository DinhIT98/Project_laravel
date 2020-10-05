<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\checkUserAdmin;


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

Route::get('/home',[PageController::class,'show_product'])->name('home');
Route::get('/category/{cate}',[PageController::class,'showProductByCategory'])->name('show.category');
Route::get('/admin/signIn',function(){
    return view('sign_in');
});
// Route::get('/detail',[PageController::class,'show_detail']);
Route::get('/product/detail/{id}',[PageController::class,'show_detail'])->name('product.detail');
Route::get('/checkout/{id}',[PageController::class,'checkout'])->name('product.checkout');
Route::get('/checkout-cart',[PageController::class,'checkoutCart']);
Route::get('/cart',[PageController::class,'cart']);
Route::post('checkout',[PageController::class,'checkout_store'])->name('checkout.store');
Route::get('/add-to-cart/{id}',[PageController::class, 'addToCart']);
Route::get('/test-cart',[PageController::class,'testCart']);
Route::delete('/remove/{id}',[PageController::class,'removeCart'])->name('removeCart');
Route::get('/login',[LoginController::class,'index']);
Route::get('/register',[RegisterController::class,'index']);
Route::post('login',[LoginController::class,'authLogin'])->name('login');
Route::post('register',[RegisterController::class,'handleRegister'])->name('register');
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::get('/test',[PageController::class,'test']);
Route::get('/admin',[AdminController::class,'showUser'])->middleware(checkUserAdmin::class)->name('showUser');
// Route::get('/admin',[AdminController::class,'showUser'])->name('showUser');


Route::group(['middleware' => [checkUserAdmin::class]], function () {
    Route::get('/admin/order',[AdminController::class,'showOrder'])->name('showOrder');
Route::get('/admin/category',[AdminController::class,'showCate'])->name('showCate');
Route::get('/admin/products',[AdminController::class,'showProducts'])->name('showProducts');
Route::get('/admin/insert-product',[AdminController::class,'insertProduct']);
Route::post('admin/store-product',[AdminController::class,'storeProduct'])->name('storeProduct');
Route::delete('delete-product/{id}',[AdminController::class,'deleteProduct'])->name('deleteProduct');
Route::get('/admin/insert-category-2',[AdminController::class,'insertCate_2']);
Route::get('/admin/insert-category-1',[AdminController::class,'insertCate_1']);
Route::get('/admin/edit-product/{id}',[AdminController::class,'editProduct'])->name('editProduct');
Route::post('delete/image',[AdminController::class, 'imageDelete'])->name('image.Delete');
Route::post('/admin/store-edit-product',[AdminController::class,'storeEditProduct'])->name('storeEditProduct');
Route::get('/admin/update-order/{id}',[AdminController::class,'updateStatusOrder'])->name("updateStatusOrder");
Route::post('/admin/store-status-order',[AdminController::class,'storeStatusOrder'])->name('storeStatusOrder');
Route::delete('/admin/delete-user/{id}',[AdminController::class,'deleteUser'])->name('deleteUser');
Route::delete('/admin/delete-category/{id}',[AdminController::class,'deleteCategory'])->name('deleteCategory');
Route::get('/admin/edit-category/{id}',[AdminController::class,'editCategory'])->name('editCategory');
Route::post('/admin/store-edit-cate',[AdminController::class,'storeEditCate'])->name('storeEditCate');
Route::post('/admin/store-insert-cate-1',[AdminController::class,'storeInsertCate_1'])->name('storeInsertCate_1');
Route::post('/admin/store-insert-cate-2',[AdminController::class,'storeInsertCate_2'])->name('storeInsertCate_2');
});
