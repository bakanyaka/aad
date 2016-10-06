<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

// Uses Auth Middleware
Route::group(['middleware' => 'auth'], function () {
    // Authentication Logout
    Route::any('logout', 'Auth\LoginController@logout');

    //Home Page
    Route::get('/', 'HomeController@index')->name('main');

    //AD Users Routes
    Route::get('users', 'Ad\AdUsersController@index')->name('users');
});





