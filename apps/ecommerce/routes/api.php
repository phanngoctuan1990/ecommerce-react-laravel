<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    Route::get('/subcategories/{category}', 'CategoryController@subCategories');
    Route::get('/categories/{subcategory}', 'CategoryController@getProductsBySubcategory');
    Route::get('/products', 'ProductController@search');
    Route::get('/products/{id}', 'ProductController@show');
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/contact', 'ContactController@store');
    Route::post('/placeorder', 'OrderController@placeOrder');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/logout', 'AuthController@logout');
        Route::get('/refresh-token', 'AuthController@refreshToken');
        Route::post('/carts/add', 'ShoppingCartController@addToCart');
        Route::delete('/carts/remove/{product_id}', 'ShoppingCartController@removeFromCart');
        Route::get('/users/cart', 'ShoppingCartController@getUserCart');
        Route::get('/users/wishlist', 'WishlistController@getUserWishlist');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
