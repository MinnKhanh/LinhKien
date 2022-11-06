<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StatisticalController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Shop;
use Illuminate\Support\Facades\Auth;
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
// ->whereYear('order.created_at', intval($request->input('year')));
//             if ($request->input('typetime') == 2) {
//                 $data->whereDay('order.created_at', $request->input('mounth'));
//             }
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'as'     => 'shop.',
    'prefix' => 'shop',
], static function () {
    Route::get('/', [Shop::class, 'index'])->name('index');
    Route::get('/detail', [Shop::class, 'detail'])->name('detail');
});
Route::group([
    'as'     => 'cart.',
    'prefix' => 'cart',
], static function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
});
Route::group([
    'as'     => 'service.',
    'prefix' => 'service',
], static function () {
    Route::get('/aboutus', [ServiceController::class, 'aboutus'])->name('aboutus');
    Route::get('/blog', [ServiceController::class, 'blog'])->name('blog');
    Route::get('/contact', [ServiceController::class, 'contact'])->name('contact');
});
Route::get('/test', function () {
    return view('test');
});
Route::group([
    'as'     => 'admin.',
    'prefix' => 'admin',
], static function () {
    Route::group([
        'as'     => 'product.',
        'prefix' => 'product',
    ], static function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::get('/update', [ProductController::class, 'update'])->name('update');
    });
    Route::group([
        'as'     => 'statistical.',
        'prefix' => 'statistical',
    ], static function () {
        Route::get('/', [StatisticalController::class, 'index'])->name('index');
    });
    Route::group([
        'as'     => 'category.',
        'prefix' => 'category',
    ], static function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/update', [CategoryController::class, 'update'])->name('update');
    });
    Route::group([
        'as'     => 'brand.',
        'prefix' => 'brand',
    ], static function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::get('/update', [BrandController::class, 'update'])->name('update');
    });
    Route::group([
        'as'     => 'vendor.',
        'prefix' => 'vendor',
    ], static function () {
        Route::get('/', [VendorController::class, 'index'])->name('index');
        Route::get('/create', [VendorController::class, 'create'])->name('create');
        Route::get('/update', [VendorController::class, 'update'])->name('update');
    });
    Route::group([
        'as'     => 'orders.',
        'prefix' => 'orders',
    ], static function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/detail', [OrderController::class, 'detailOrder'])->name('detail');
    });
});
