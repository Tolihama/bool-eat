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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::get('/restaurants', 'RestaurantController@index');
    Route::get('/restaurants/{restaurant}', 'RestaurantController@show');
    Route::get('/restaurants/categories_filter/{categories}', 'RestaurantController@filtered_by_categories');
    Route::get('/categories', 'CategoriesController@index');
    Route::get('/{restaurant}/dishes', 'DishesController@index');

    // Braintree payment system
    Route::get('/payment-token', 'CheckoutController@payment_token');
    Route::post('/payment-request', 'CheckoutController@payment_request');
});
