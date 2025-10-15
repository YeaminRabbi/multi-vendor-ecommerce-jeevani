<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function() {

    // Auth Routes
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);


    // User Module Routes
    Route::resource('/user', UserController::class);

    // Product Routes
    Route::resource('/product', ProductController::class);

    // Category Routes
    Route::resource('/category', CategoryController::class);

    // Shop or Store Routes
    Route::resource('/store', StoreController::class);

    // fetch category wise product
    Route::get('category-products', [ProductController::class, 'categoryProducts']);

    // Cart Routes
    Route::post('/add-to-cart', [\App\Http\Controllers\Frontend\CartController::class, 'addToCart']);
    Route::get('/get-cart-product', [\App\Http\Controllers\Frontend\CartController::class, 'getCartProduct']);
    Route::get('/get-cart-product/count', [\App\Http\Controllers\Frontend\CartController::class, 'getCartProductCount']);
    Route::post('/update-cart-product/{id}', [\App\Http\Controllers\Frontend\CartController::class, 'updateCartItem']);
    Route::delete('/delete-cart-product/{id}', [\App\Http\Controllers\Frontend\CartController::class, 'deleteCartItem']);

    Route::middleware(['auth:sanctum'])->group(function () {
        
        Route::get('user-info', [UserController::class, 'userInfo']);
        Route::resource('notifications', NotificationController::class);
        
        // Order routes
        Route::resource('order', OrderController::class);
        Route::post('/place-order/{apiResponse?}', [\App\Http\Controllers\Frontend\OrderController::class, 'placeOrder']);

        // Account settings routes
        Route::post('settings/update/user-info', [UserController::class, 'updateUserInfo']);
        Route::post('settings/update/password', [UserController::class, 'updatePassword']);
        Route::post('settings/account/delete', [UserController::class, 'accountDelete']);

    });
    

});