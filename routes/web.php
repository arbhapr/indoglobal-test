<?php

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

Auth::routes();

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/', ['uses' => 'DashboardController@index'])->name('dashboard');

    Route::group([
        'prefix' => '/my-profile',
        'as' => 'my-profile.',
    ], function () {
        Route::get('/', ['uses' => 'ProfileController@edit'])->name('edit');
        Route::put('/', ['uses' => 'ProfileController@update'])->name('update');
    });

    Route::group([
        'prefix' => '/management',
        'as' => 'manage.'
    ], function () {
        // Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('category', 'CategoryController')->except(['show']);
    });
});
