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
});

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
  Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::post('login', 'Auth\LoginController@login')->name('login');
  Route::post('logout', 'Auth\LoginController@logout')->name('logout');

  Route::get('/', 'HomeController@index');
  Route::resource('report', DailyReportController::class);
  Route::resource('store', StoreController::class);

  Route::resource('adminuser', AdminUserController::class);
  Route::get('adminuser/{adminuser}/mailedit', 'AdminUserController@mailedit')->name('adminuser.mailedit');
  Route::post('adminuser/sendmail', 'AdminUserController@sendmail')->name('adminuser.sendmail');
  Route::resource('user', 'UserController');
  Route::POST('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  Route::GET('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::POST('password/reset','Auth\ResetPasswordController@reset')->name('password.request');
  Route::GET('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

  Route::resource('user', UserController::class);
  Route::resource('schedule', WorkScheduleController::class);
});
