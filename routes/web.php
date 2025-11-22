<?php

use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [HomeController::class, 'userIndexPage'])->name('page-user-home');

Route::get('/product', [ProductController::class, 'userProductPage'])->name('page-user-product-list');
Route::get('/product/search/{keyword}', [ProductController::class, 'searchProduct'])->name('page-user-product-search');
Route::get('/product/detail/{id}', [ProductController::class, 'userProductDetailPage'])->name('page-user-product-detail');
Route::get('/product/detail/{id}/comment', [ProductController::class, 'getComments'])->name('section-user-product-comment');

Route::get('/about-us', [AboutController::class, 'index'])->name('page-about-us');

Route::get('/login', [AuthController::class, 'loginPage'])->name('page-user-login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('do-user-login');
Route::get('/logout', [AuthController::class, 'logoutUser'])->name('do-user-logout');

Route::get('/register', [AuthController::class, 'userRegisterPage'])->name('page-user-register');
Route::post('/register', [AuthController::class, 'registerUser'])->name('do-user-register');

Route::group(['middleware' => ['checkauth:admin']], function () {
    Route::get('admin', [HomeController::class, 'adminIndexPage'])->name('page-admin-home');

    Route::get('/admin/product', [ProductController::class, 'productListPage'])->name('page-admin-product-list');
    Route::get('/admin/product/search/{keyword}', [ProductController::class, 'searchProductAdmin'])->name('page-admin-product-search');
    Route::get('/admin/product/add', [ProductController::class, 'addProductPage'])->name('page-admin-product-add');
    Route::post('/admin/product/add', [ProductController::class, 'addProduct'])->name('do-admin-product-add');
    Route::get('/admin/product/update/{id}', [ProductController::class, 'updateProductPage'])->name('page-admin-product-update');
    Route::post('/admin/product/update/{id}', [ProductController::class, 'updateProduct'])->name('do-admin-product-update');
    Route::delete('/admin/product/delete/{id}', [ProductController::class, 'removeProduct'])->name('do-admin-product-delete');

    Route::get('/admin/type', [ProductTypeController::class, 'productTypeListPage'])->name('page-admin-type-list');
    Route::get('/admin/type/search/{keyword}', [ProductTypeController::class, 'searchTypeAdmin'])->name('page-admin-type-search');
    Route::get('/admin/type/add', [ProductTypeController::class, 'addProductTypePage'])->name('page-admin-type-add');
    Route::post('/admin/type/add', [ProductTypeController::class, 'addProductType'])->name('do-admin-type-add');
    Route::get('/admin/type/update/{id}', [ProductTypeController::class, 'updateProductTypePage'])->name('page-admin-type-update');
    Route::post('/admin/type/update/{id}', [ProductTypeController::class, 'updateProductType'])->name('do-admin-type-update');
    Route::delete('/admin/type/delete/{id}', [ProductTypeController::class, 'removeProductType'])->name('do-admin-type-delete');

    Route::get('/admin/user', [UserController::class, 'userListPage'])->name('page-admin-user-list');
    Route::delete('/admin/user/delete/{id}', [UserController::class, 'removeUser'])->name('do-admin-user-delete');

    Route::get('/admin/invoice', [OrderController::class, 'adminOrderListPage'])->name('page-admin-order-list');
    Route::get('/admin/invoice/detail/{id}', [OrderController::class, 'adminOrderDetailPage'])->name('page-admin-order-detail');
    Route::post('/admin/invoice/detail/{id}', [OrderController::class, 'updateOrder'])->name('do-admin-order-update');
    Route::get('/admin/invoice/search', [OrderController::class, 'adminSearchOrder'])->name('page-admin-order-search');

    Route::get('/admin/statistical/', [StatisticController::class, 'index'])->name('page-admin-statistic');
    Route::get('/admin/statistical/{type}', [StatisticController::class, 'getStatistic'])->name('do-admin-statistic');
});

Route::group(['middleware' => ['checkauth:user']], function () {
    Route::get('/cart', [CartController::class, 'userCartPage'])->name('page-user-cart-list');
    Route::post('/cart', [CartController::class, 'addToCart'])->name('do-user-cart-add');
    Route::put('/cart', [CartController::class, 'updateCart'])->name('do-user-cart-update');
    Route::delete('/cart', [CartController::class, 'removeFromCart'])->name('do-user-cart-delete');

    Route::post('/product/detail/{id}/comment', [ProductController::class, 'addComment'])->name('do-user-comment-add');

    Route::get('/user/profile', [UserController::class, 'userProfilePage'])->name('page-user-profile');
    Route::post('/user/profile', [UserController::class, 'updateProfile'])->name('do-user-profile-update');

    Route::get('/user/password', [AuthController::class, 'userChangePasswordPage'])->name('page-user-pwd-change');
    Route::post('/user/password', [AuthController::class, 'changeUserPassword'])->name('do-user-pwd-change');

    Route::get('/user/purchase-history/', [OrderController::class, 'userPurchaseHistoryPage'])->name('page-user-order-list');
    Route::get('/user/purchase-history/{id}', [OrderController::class, 'userPurchaseHistoryDetailPage'])->name('page-user-order-detail');

    Route::post('/order', [OrderController::class, 'addOrder'])->name('do-user-order-place');
    Route::delete('/order', [OrderController::class, 'cancelOrder'])->name('do-user-order-cancel');
    Route::post('/order/payment/vnpay', [OrderController::class, 'payByVNPay'])->name('do-user-payment');
    Route::get('/order/payment/vnpay/webhook/{fullname}/{phone}/{email}/{address}/{requirements}/{paymentmethod}/{id_user}',
               [OrderController::class, 'returnVNPay'])->name('do-user-payment-complete');
});

Route::group([], function() {
    Route::post('/api/login', [APIController::class, 'getProducts']);
    Route::post('/api/register', [APIController::class, 'register']);
    Route::get('/api/products', [APIController::class, 'getProducts']);
    Route::get('/api/products/{id}', [APIController::class, 'getProduct']);
    Route::get('/api/products/{id}/comments', [APIController::class, 'getProductComments']);
    Route::get('/api/categories', [APIController::class, 'getCategories']);
    Route::get('/api/categories/{id}', [APIController::class, 'getCategory']);
});
