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

// Authentication routes (backoffice)
Route::middleware('auth')
    ->namespace('admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        // rotte autenticate da aggiungere...
    });

Auth::routes();

    // Front SPA route
Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');