<?php

use App\Http\Controllers\Api\CTVController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\WalletController;

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
Route::get('/dat-hang-san-pham', [ProductController::class, 'viewOrderKH'])->name('viewOrderKH');
Route::post('/dat-hang', [ProductController::class, 'createOrderKH'])->name('createOrderKH');

Route::get('/danh-sach-san-pham/{page}', [ProductController::class, 'listProduct'])->name('danh-sach-san-pham');
Route::get('/chi-tiet-san-pham/id={id}', [ProductController::class, 'detailProduct'])->name('chi-tiet-san-pham');
Route::get('/them-gio-hang', [ProductController::class, 'addCart'])->name('them-gio-hang');
Route::get('/xoa-gio-hang/{id}', [ProductController::class, 'deleteCart'])->name('deleteCart');
Route::get('/cap-nhat-gio-hang', [ProductController::class, 'updateCart'])->name('updateCart');


Route::get('/gio-hang', [ProductController::class, 'detailCart'])->name('gio-hang');
Route::get('/thong-tin-dat-hang', [ProductController::class, 'infoOrder'])->name('thong-tin-dat-hang');
Route::post('/them-don-hang', [ProductController::class, 'createOrder'])->name('them-don-hang');
Route::get('/danh-sach-mua-san-pham/{page}', [ProductController::class, 'listOrder'])->name('danh-sach-mua-san-pham');
Route::get('/chi-tiet-don-hang/id={id}', [ProductController::class, 'detailOrder'])->name('detailOrder');
Route::get('/excel-order', [ProductController::class, 'excelOrder'])->name('excelOrder');

Route::get('/bai-dang/{page}', [ProductController::class, 'listContent'])->name('listContent');
Route::get('/chi-tiet-bai-dang/{id}', [ProductController::class, 'detailContent'])->name('detailContent');

Route::get('/goi-sua', [CTVController::class, 'Packet'])->name('goi-sua');
Route::get('/goi-mua-sua', [CTVController::class, 'buyPacket'])->name('goi-mua-sua');
Route::get('/chi-tiet-goi-mua/id={id}', [CTVController::class, 'buyPacketDetail'])->name('chi-tiet-goi-mua');
Route::get('/huy-goi-mua/id={id}', [CTVController::class, 'deleteBuyPacket'])->name('huy-goi-mua');
Route::get('/excel-packet', [ProductController::class, 'excelPacket'])->name('excelPacket');

Route::get('/ctv-tuyen-duoi', [CTVController::class, 'CTVrevenue'])->name('ctv-tuyen-duoi');
Route::get('/chi-tiet-doanh-thu/id={id}', [CTVController::class, 'CTVrevenueDetail'])->name('chi-tiet-doanh-thu');

Route::get('/cong-doanh-so', [CTVController::class, 'CTVcalculator'])->name('cong-doanh-so');
Route::get('/chi-tiet-cong-doanh-so/id={id}', [CTVController::class, 'CTVcalculatorDetail'])->name('chi-tiet-cong-doanh-so');
Route::post('/updateADD/{id}', [CTVController::class, 'updateADD'])->name('updateADD');
Route::post('/deleteADD/{id}', [CTVController::class, 'deleteADD'])->name('deleteADD');

Route::get('/chi-tiet-goi-sua/id={id}', [CTVController::class, 'Packetdetail'])->name('chi-tiet-goi-sua');
Route::get('/dat-mua-sua/id={id}', [CTVController::class, 'Order'])->name('dat-mua-sua');

Route::post('/register', [CTVController::class, 'register'])->name('register');
Route::post('/login', [CTVController::class, 'login'])->name('login');
Route::get('/logout', [CTVController::class, 'logout'])->name('logout');
Route::get('/trang-chu', [CTVController::class, 'getUserInfo'])->name('trang-chu');
Route::get('/updateCTV', [CTVController::class, 'updateCTV'])->name('updateCTV');
Route::get('/PassCTV', [CTVController::class, 'PassCTV'])->name('PassCTV');
Route::post('/comfirmOrder', [CTVController::class, 'comfirmOrder'])->name('comfirmOrder');
Route::post('/comfirmDddrevenue', [CTVController::class, 'comfirmDddrevenue'])->name('comfirmDddrevenue');

Route::post('/notify', [CTVController::class, 'notify'])->name('notify');
Route::get('/thong-bao/page={i}', [CTVController::class, 'notifyy'])->name('listNotify');

Route::get('/thong-tin-ca-nhan','CTVController@informationCtv')->name('informationCtv');
// Route::get('/thong-tin-ca-nhan', function () {

//     return view('includes.information-ctv');
// });
Route::put('/update-InformationCtv/{user_id}', 'CTVController@updateCtv')->name('update-InformationCtv');
Route::get('/excel-ctv', 'CTVController@excelCTV')->name('excelCTV');

Route::get('/vi-tien/{page}', [WalletController::class, 'myWallet'])->name('myWallet');
Route::view('/them-giao-dich', 'includes.wallet.addWallet')->name('addWallet');
Route::post('/create-wallet', [WalletController::class, 'createWallet'])->name('createWallet');
Route::get('/vi-thuong/{page}', [WalletController::class, 'rewardWallet'])->name('rewardWallet');
Route::post('/rut-vi-thuong', [WalletController::class, 'rewardToWallet'])->name('rewardToWallet');
Route::get('/chi-tiet-giao-dich/{type}/id={id}', [WalletController::class, 'detailWallet'])->name('detailWallet');

// Route::view('/chia-se-san-pham', 'includes.shareProduct.shareProduct');