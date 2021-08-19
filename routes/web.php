<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\CategoryController;

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
Route::get('/trang-chu', [UserController::class, 'getUserInfo'])->name('trang-chu');

Route::prefix('danh-muc')->name('category.')->group(function () {
    Route::get('/danh-muc-cha', [CategoryController::class, 'listCategory'])->name('listCategory');
    Route::post('/them-moi-danh-muc-cha', [CategoryController::class, 'addParrent'])->name('addParrent');
    Route::post('/xoa-danh-muc-cha/{id}', [CategoryController::class, 'deleteParrent'])->name('delete');
});



