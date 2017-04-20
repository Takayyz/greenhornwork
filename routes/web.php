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
  Route::resource('report', 'DailyReportController');
  Route::resource('/schedule', 'WorkScheduleController');
  Route::post('/register', 'Auth\RegisterController@register');
  Route::get('/register/{query}', 'Auth\RegisterController@showRegistrationForm');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
  Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
  Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
  Route::post('logout', 'Auth\LoginController@logout');

  Route::get('/', 'HomeController@index');
  Route::resource('report', DailyReportController::class);
  Route::resource('store', StoreController::class);

  Route::resource('adminuser', AdminUserController::class);
  Route::get('adminuser/{adminuser}/mailedit', 'AdminUserController@mailedit')->name('adminuser.mailedit');
  Route::post('adminuser/sendmail', 'AdminUserController@sendmail')->name('adminuser.sendmail');
  Route::resource('user', 'UserController');

  Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AdminRegisterController@adminRegister']);
  Route::get('/register/', 'Auth\AdminRegisterController@showAdminRegistrationForm');

  Route::resource('user', UserController::class);
  Route::resource('schedule', WorkScheduleController::class);
});
