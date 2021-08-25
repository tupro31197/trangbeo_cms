<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\RateController;
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

Route::view('/', 'welcome')->name('dang-nhap');
Route::view('/dang-ki', 'includes.register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/trang-chu', [CategoryController::class, 'listCategory'])->name('trang-chu');
Route::post('/cap-nhat-thong-tin-thanh-toan', [UserController::class, 'updateInfoPayment'])->name('updateInfoPayment');

Route::get('/trang-chu', [CategoryController::class, 'listCategory'])->name('trang-chu');

Route::prefix('danh-muc')->name('category.')->group(function () {
    Route::get('/danh-muc-cha', [CategoryController::class, 'listCategory'])->name('listCategory');
    Route::post('/them-moi-danh-muc-cha', [CategoryController::class, 'addParrent'])->name('addParrent');
    Route::post('/cap-nhat-danh-muc-cha', [CategoryController::class, 'updateParrent'])->name('updateParrent');
    Route::post('/xoa-danh-muc-cha/{id}', [CategoryController::class, 'deleteParrent'])->name('delete');

    Route::post('/them-moi-danh-muc-mon-an', [CategoryController::class, 'addChild'])->name('addChild');
    Route::get('/danh-muc-mon-an/{id}', [CategoryController::class, 'listChild'])->name('listChild');
    Route::get('/tim-kiem', [CategoryController::class, 'listChildFromParrent'])->name('listChildFromParrent');
    Route::post('/cap-nhat-danh-muc-mon-an', [CategoryController::class, 'updateChild'])->name('updateChild');
    Route::post('/xoa-danh-muc-mon-an/{id}', [CategoryController::class, 'deleteChild'])->name('deleteChild');
});

Route::prefix('mon-an')->name('dish.')->group(function () {
    Route::get('/danh-sach/{page}', [DishController::class, 'listDish'])->name('listDish');
    Route::get('/chi-tiet/{id}', [DishController::class, 'detailDish'])->name('detailDish');
    Route::post('/them-moi-mon-an', [DishController::class, 'addDish'])->name('addDish');
    Route::post('/cap-nhat-mon-an', [DishController::class, 'updateDish'])->name('updateDish');
    Route::post('/xoa-mon-an/{id}', [DishController::class, 'deleteParrent'])->name('delete');

    Route::post('/them-moi-topping', [DishController::class, 'addDishTopping'])->name('addDishTopping');
    Route::post('/xoa-topping/{id}', [DishController::class, 'deleteTopping'])->name('deleteTopping');
    Route::post('/cap-nhat-topping', [DishController::class, 'updateDishTopping'])->name('updateDishTopping');

});

Route::prefix('voucher')->name('voucher.')->group(function () {
    Route::get('/danh-sach/{page}', [VoucherController::class, 'listVoucher'])->name('listVoucher');
    Route::post('/them-moi', [VoucherController::class, 'addVoucher'])->name('addVoucher');
    Route::post('/cap-nhat/{id}', [VoucherController::class, 'updateVoucher'])->name('updateVoucher');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/danh-sach/{page}', [UserController::class, 'listUser'])->name('listUser');
});

Route::prefix('don-hang')->name('order.')->group(function () {
    Route::get('/danh-sach/{page}/trang-thai={status}', [OrderController::class, 'listOrder'])->name('listOrder');
    Route::post('/cap-nhat/{code}', [OrderController::class, 'updateOrder'])->name('updateOrder');
    Route::post('/cap-nhat-danh-muc-cha', [CategoryController::class, 'updateParrent'])->name('updateParrent');
    Route::post('/xoa-danh-muc-cha/{id}', [CategoryController::class, 'deleteParrent'])->name('delete');
});

Route::prefix('danh-gia')->name('rate.')->group(function () {
    Route::get('/', [RateController::class, 'listRate'])->name('listRate');
});
