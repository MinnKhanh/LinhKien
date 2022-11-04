<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Shop;
use App\Http\Livewire\Service\Cart;
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

// Route::get('/', function () {
//     return view('welcome');
// });

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
    Route::get('/home', [AdminController::class, 'index'])->name('index');
    Route::group([
        'as'     => 'product.',
        'prefix' => 'product',
    ], static function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::get('/update', [ProductController::class, 'update'])->name('update');
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
});
