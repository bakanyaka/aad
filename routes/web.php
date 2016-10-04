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
    Route::get('/', 'HomeController@index');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('logout', 'Auth\LoginController@logout');
});





