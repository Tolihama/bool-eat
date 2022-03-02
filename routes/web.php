<?php

use Illuminate\Support\Facades\Route;
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

// Authentication user routes (backoffice)
Route::middleware('auth')
    ->namespace('admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('/dishes', 'DishesController');
        Route::resource('/restaurant', 'RestaurantController');
        Route::get('/restaurant/{restaurant}/confirm-delete', 'RestaurantController@confirm_delete')->name('restaurant.confirm-delete');

        // Admin route doesn't exist: redirect to dashboard
        Route::get('{any?}', function() {
            return redirect()->route('admin.home');
        })->where('any', '.*');
    });

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/registration-confirmed', function() {
        return view('auth.register-success');
    })->name('registration-confirmed');
});

// Front SPA route
Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');