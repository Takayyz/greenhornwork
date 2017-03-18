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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => '/user'], function() {
  Route::get('/', 'UserController@index');
  Route::get('/home', 'UserController@index');
  Route::resource('/report', 'DailyReportController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
  $this->get('login', 'Auth\LoginController@showLoginForm');
  $this->post('login', 'Auth\LoginController@login');
  $this->post('logout', 'Auth\LoginController@logout');

  Route::get('/', 'HomeController@index');
  Route::get('/home', 'HomeController@index');
  Route::resource('/user-report', 'DailyReportController');
});
