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

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
  Route::get('login', 'Auth\LoginController@showLoginForm');
  Route::post('login', 'Auth\LoginController@login');
  Route::post('logout', 'Auth\LoginController@logout');

  Route::get('/', 'HomeController@index');
  Route::resource('report', DailyReportController::class);
  Route::resource('store', StoreController::class);

  Route::resource('adminuser', AdminUserController::class);
  //Route::resourceを使う事により、AdminUserControllerの中のCRUDへのルートを定義する事が出来る。
  Route::resource('user', UserController::class);
});
