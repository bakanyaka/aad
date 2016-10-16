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
Route::any('logout', 'Auth\LoginController@logout')->middleware('auth');

// Uses Auth and Admin Middleware
Route::group(['middleware' => ['auth','admin']], function () {
    //Home Page
    Route::get('/', 'HomeController@index')->name('main');
    //AD Users Routes
    Route::get('users', 'Ad\AdUsersController@index')->name('users');
    Route::get('users/search','Ad\AdUsersController@search');
    Route::get('computers/search', 'Ad\AdComputersController@search');
    //Redmine Routes
    Route::get('todo/issues/new', 'Todo\TodoIssuesController@create');
    Route::post('todo/issues/new', 'Todo\TodoIssuesController@store');
});

/*Route::get('/',  function (App\Repositories\Ad\AdUserRepository $userRepo, App\Repositories\Ad\AdDepartmentRepository $depRepo ) {
    dd($userRepo->findByName('Дмитрий'));
});*/



