<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\checkUserAdmin;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ExportController;


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

Route::get('/',[PageController::class,'show_product'])->name('home');
Route::get('/category/{cate}',[PageController::class,'showProductByCategory'])->name('show.category');
Route::get('/admin/signIn',function(){
    return view('sign_in');
});
// Route::get('/detail',[PageController::class,'show_detail']);
Route::get('/product/detail/{id}',[PageController::class,'show_detail'])->name('product.detail');
Route::get('/checkout/{id}',[PageController::class,'checkout'])->name('product.checkout');
Route::get('/checkout-cart',[PageController::class,'checkoutCart']);
Route::post('/checkout-cart',[PageController::class,'postCheckoutCart'])->name('postCheckoutCart');
Route::get('/cart',[PageController::class,'cart']);
Route::post('checkout',[PageController::class,'checkout_store'])->name('checkout.store');
Route::post('/checkout-cart-store',[PageController::class,'checkoutCartStore'])->name('checkoutCartStore');
Route::get('/add-to-cart/{id}',[PageController::class, 'addToCart']);
Route::get('/test-cart',[PageController::class,'testCart']);
// Route::post('/remove-cart',[PageController::class,'removeCart'])->name('removeCart');
Route::get('/login',[LoginController::class,'index']);
Route::get('/register',[RegisterController::class,'index']);
Route::post('login',[LoginController::class,'authLogin'])->name('login');
Route::post('register',[RegisterController::class,'handleRegister'])->name('register');
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::post('/test',[PageController::class,'deleteAndCheckoutCart'])->name('deleteAndCheckoutCart');
Route::post('/search/name',[PageController::class,'search'])->name('search');
Route::post('/add-to-cart-ajax',[PageController::class,'addToCartAjax'])->name('addToCartAjax');
Route::get('/get-cart',[PageController::class,'getCart'])->name('getCart');
Route::post('/remove-cart-ajax',[PageController::class,'removeCartAjax'])->name('removeCartAjax');
Route::post('/update-cart',[PageController::class,'updateCart'])->name('updateCart');
Route::get('/get-total-cart',[PageController::class,'getTotalCart'])->name('getTotalCart');
Route::get('/test',[PageController::class,'testNews']);
// Route::get('/admin',[AdminController::class,'showUser'])->middleware(checkUserAdmin::class)->name('showUser');

// Route::get('/admin',[AdminController::class,'showUser'])->name('showUser');

Route::group(['middleware' => [checkUserAdmin::class]], function () {
Route::get('/admin',[AdminController::class,'showUser'])->name('showUser');
Route::get('/admin/order',[AdminController::class,'showOrder'])->name('showOrder');
Route::get('/admin/category',[AdminController::class,'showCate'])->name('showCate');
Route::get('/admin/products',[AdminController::class,'showProducts'])->name('showProducts');
Route::get('/admin/news',[AdminController::class,'showNews'])->name('showNews');
Route::get('/admin/insert-new',[AdminController::class,'insertNew'])->name('insertNew');
Route::post('/admin/store-insert-new',[AdminController::class,'storeInsertNew'])->name('storeInsertNew');
Route::post('/admin/delete-new',[AdminController::class,'deleteNew'])->name('deleteNew');
Route::get('/admin/edit-news/{id}',[AdminController::class,'editNews'])->name('editNews');
Route::post('/admin/store-edit-news',[AdminController::class,'storeEditNews'])->name('storeEditNews');
Route::post('/admin/delete-image-news',[AdminController::class,'deleteImageNews'])->name('deleteImageNews');
Route::get('/admin/insert-product',[AdminController::class,'insertProduct']);
Route::post('admin/store-product',[AdminController::class,'storeProduct'])->name('storeProduct');
Route::post('delete-product',[AdminController::class,'deleteProduct'])->name('deleteProduct');
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
Route::get('/admin/file-export-users',[ExportController::class,'fileExportUsers'])->name('fileExportUsers');
Route::get('/admin/import',[AdminController::class,'import'])->name('import');
Route::post('/admin/file-import',[ImportController::class,'fileImport'])->name('fileImport');
Route::get('/admin/file-export-products',[ExportController::class,'fileExportProducts'])->name('fileExportProducts');
Route::get('/admin/file-export-order',[ExportController::class,'fileExportOrders'])->name('fileExportOrders');
});
