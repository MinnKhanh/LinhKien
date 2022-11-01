<?php


use App\Http\Controllers\CartController;
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

Route::get('/', function () {
    return view('welcome');
});

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
