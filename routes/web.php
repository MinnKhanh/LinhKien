<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\IntroduceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderImport;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopInformation;
use App\Http\Controllers\Admin\StatisticalController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Auth\ChangePassword;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Shop;
use App\Http\Controllers\UserController;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\RoleHasPermisson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/dash', [AdminController::class, 'index'])->name('dash');
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
    'middleware' => 'auth'
], static function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
});
Route::group([
    'as'     => 'service.',
    'prefix' => 'service',
], static function () {
    Route::get('/aboutus', [ServiceController::class, 'aboutus'])->name('aboutus');
    Route::get('/news', [ServiceController::class, 'news'])->name('news');
    Route::get('/new-detail', [ServiceController::class, 'newDetail'])->name('newdetail');
    Route::get('/contact', [ServiceController::class, 'contact'])->name('contact');
    Route::get('/coupons', [ServiceController::class, 'coupons'])->name('coupons');
});
Route::get('/test', function () {
    return view('shop.index', ['active' => 1]);
    // dd(DB::getQueryLog());
    // $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
});
Route::group([
    'as'     => 'admin.',
    'prefix' => 'admin',
    'middleware' => 'auth'
], static function () {
    Route::group([
        'as'     => 'main.',
        'prefix' => 'main',
    ], static function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
    });

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
        Route::get('/print-order', [OrderController::class, 'printOrder'])->name('prictorder');
        Route::get('/sendmail', [OrderController::class, 'sendOrderToMail'])->name('sendmail');
    });
    Route::group([
        'as'     => 'customers.',
        'prefix' => 'customers',
    ], static function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        // Route::get('/detail', [OrderController::class, 'detailOrder'])->name('detail');
        // Route::get('/sendmail', [OrderController::class, 'sendOrderToMail'])->name('sendmail');
    });
    Route::group([
        'as'     => 'orderimport.',
        'prefix' => 'orderimport',
    ], static function () {
        Route::get('/', [OrderImport::class, 'index'])->name('index');
        Route::get('/create', [OrderImport::class, 'create'])->name('create');
        Route::get('/detail', [OrderImport::class, 'detail'])->name('detail');
        Route::get('/checkout', [OrderImport::class, 'checkout'])->name('checkout');
        Route::get('/printorder', [OrderImport::class, 'printorder'])->name('printorder');
    });
    Route::group([
        'as'     => 'discount.',
        'prefix' => 'discount',
    ], static function () {
        Route::get('/', [DiscountController::class, 'index'])->name('index');
        Route::get('/edit', [DiscountController::class, 'edit'])->name('edit');
        Route::get('/create', [DiscountController::class, 'create'])->name('create');
        // Route::get('/detail', [OrderController::class, 'detailOrder'])->name('detail');
        // Route::get('/sendmail', [OrderController::class, 'sendOrderToMail'])->name('sendmail');
    });
    Route::group([
        'as'     => 'introduce.',
        'prefix' => 'introduce',
    ], static function () {
        Route::get('/', [IntroduceController::class, 'index'])->name('index');
        Route::get('/create-slide-intro', [IntroduceController::class, 'createSlideIntro'])->name('createslideintro');
        Route::get('/edit-slide-intro', [IntroduceController::class, 'editSlideIntro'])->name('editslideintro');
        Route::get('/edit-discount-intro', [IntroduceController::class, 'editDiscountIntro'])->name('editdiscountintro');
        Route::get('/create-discount-intro', [IntroduceController::class, 'createDiscountIntro'])->name('creatediscountintro');
        Route::get('/customize-slide-intro', [IntroduceController::class, 'customizeSlideIntro'])->name('customizeslideintro');
    });
    Route::group([
        'as'     => 'inforshop.',
        'prefix' => 'inforshop',
    ], static function () {
        Route::get('/create-news', [ShopInformation::class, 'news'])->name('createnew');
        Route::get('/list-news', [ShopInformation::class, 'listnews'])->name('listnews');
        Route::get('/edit-new', [ShopInformation::class, 'editNew'])->name('editnew');
        Route::get('/aboutus', [ShopInformation::class, 'aboutus'])->name('aboutus');
        // Route::get('/news', [ShopInformation::class, 'news'])->name('news');
    });
});
// Route::get('/test', function () {
//     dd(OrderDetail::where('order_id', 1)->get()->toArray());
// })->name('detail');
Route::group([
    'as'     => 'order.',
    'prefix' => 'order',
], static function () {
    Route::get('/', [ControllersOrderController::class, 'index'])->name('index');
    Route::get('/detail', [ControllersOrderController::class, 'detailOrder'])->name('detail');
    Route::get('/sendmail', [ControllersOrderController::class, 'sendOrderToMail'])->name('sendmail');
});
Route::group([
    'as'     => 'user.',
    'prefix' => 'user',
], static function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/update', [UserController::class, 'update'])->name('update');
    Route::get('/favorite', [UserController::class, 'productFavorite'])->name('favorite')->middleware('auth');
    Route::get('/changepassword', [UserController::class, 'changePassword'])->name('viewchangepassword')->middleware('auth');
    Route::post('/changepassword', [UserController::class, 'updatePassword'])->name('changepassword')->middleware('auth');
});
