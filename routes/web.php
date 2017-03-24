<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index');

Route::group(['prefix' => '/'], function() {
  Route::get('/', function () {
      return view('auth.login');
  });
  Route::get('/', 'UserController@index');
  Route::get('/home', 'UserController@index');
  Route::resource('/report', 'DailyReportController');
  Route::resource('/schedule', 'WorkScheduleController');
  Route::post('/upload', 'WorkScheduleController@upload');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
  Route::get('login', 'Auth\LoginController@showLoginForm');
  Route::post('login', 'Auth\LoginController@login');
  Route::post('logout', 'Auth\LoginController@logout');

  Route::get('/', 'HomeController@index');
  Route::get('/home', 'HomeController@index');
  Route::resource('/report', 'DailyReportController');
  Route::resource('/store', 'StoreController'); 
});
