<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Middleware\CheckRole;
use App\Pages\SellerLogin;
use App\Pages\SellerRegistration;
use Illuminate\Support\Facades\Route;

// Include the auth routes
require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [CommonController::class, 'about'])->name('about');
Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/error', [HomeController::class, 'error'])->name('error');
Route::get('/contact', [CommonController::class, 'contact'])->name('contact');

Route::any('/survey', [HomeController::class, 'survey'])->name('question.survey');
Route::post('/questionnaire/store', [HomeController::class, 'storeAnswer'])->name('questionnaire.store');
Route::any('/recommand-for-you', [HomeController::class, 'recommendProduct'])->name('recommand.product.for.you');

Route::get('/store', [StoreController::class, 'store'])->name('store.list');
Route::get('/store/{slug?}', [StoreController::class, 'storeSingle'])->name('store.single');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop.list');
Route::get('/shop/{slug?}', [ShopController::class, 'shopSingle'])->name('shop.single');

Route::get('/blog', [CommonController::class, 'blog'])->name('blog.list');
Route::get('/blog/BLOG-SLUG', [CommonController::class, 'blogSingle'])->name('blog.single');
Route::get('/blog/category', [CommonController::class, 'blogCategory'])->name('blog.category');

Route::post('/add-to-cart/{redirectPage?}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');

Route::get('/search', [CommonController::class, 'productSearch'])->name('products.search');

Route::get('/page/{slug}', [CommonController::class, 'getPage'])->name('get.page');

Route::group(['prefix' => 'dashboard','middleware' => ['auth']], function() {

    Route::get('/checkout', [CheckController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [CommonController::class, 'order'])->name('account.order');
    Route::get('/order/items/{order}/{notificationId?}', [CommonController::class, 'orderItems'])->name('account.order.items');
    Route::get('/settings', [CommonController::class, 'settings'])->name('account.settings');
    Route::get('/payment-method', [CommonController::class, 'paymentMethod'])->name('account.payment.method');
    Route::get('/notifications', [CommonController::class, 'notification'])->name('account.notification');

    Route::post('/update/user/info', [CommonController::class, 'updateUserInfo'])->name('update.user.info');
    Route::post('/update/user/password', [CommonController::class, 'updateUserPassword'])->name('update.user.password');
    Route::post('/account/delete', [CommonController::class, 'deleteAccount'])->name('delete.user.account');

    Route::resource('address', AddressController::class);
    Route::get('address/{id}/default', [AddressController::class, 'setDefault'])->name('address.default');

    Route::post('/store-review/{product}', [CommonController::class, 'storeReview'])->name('store.review');

});

Route::middleware([CheckRole::class.':admin'])->group(function () {
    // Define routes that require the 'admin' role here
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
