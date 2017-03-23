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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => '/user'], function() {
  Route::get('/', 'UserController@index');
  Route::get('/home', 'UserController@index');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
  $this->get('login', 'Auth\LoginController@showLoginForm');
  $this->post('login', 'Auth\LoginController@login');
  $this->post('logout', 'Auth\LoginController@logout');

  Route::get('/', 'HomeController@index');
  // Route::get('/home', 'HomeController@index');

  Route::resource('adminuser', 'AdminUserController');
  //Route::resourceを使う事により、AdminUserControllerの中のCRUDへのルートを定義する事が出来る。
  Route::resource('user', 'UserController');
});

