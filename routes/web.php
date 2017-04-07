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
  Route::get('/report/search', ['as' => 'report.search', 'uses' => 'DailyReportController@search']);
  Route::resource('report', 'DailyReportController');
  Route::resource('/schedule', 'WorkScheduleController');
  Route::post('/upload', 'WorkScheduleController@upload');
  Route::get('showadminregister', 'Admin\Auth\AdminRegisterController@showAdminRegistrationForm')->name('showadminregister');
  Route::post('adminregister', 'Admin\Auth\AdminRegisterController@adminRegister')->name('adminregister');
  Route::get('adminmaileditform', 'Admin\Auth\AdminRegisterController@showAdminMailEditForm')->name('adminmaileditform');
  Route::post('adminmailupdate', 'Admin\Auth\AdminRegisterController@adminEmailUpdate')->name('adminmailupdate');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
  Route::get('login', 'Auth\LoginController@showLoginForm');
  Route::post('login', 'Auth\LoginController@login');
  Route::post('logout', 'Auth\LoginController@logout');

  Route::get('/', 'HomeController@index');
  Route::get('/report/search', ['as' => 'report.search', 'uses' => 'DailyReportController@search']);
  Route::resource('report', DailyReportController::class);
  Route::resource('store', StoreController::class);

  Route::resource('adminuser', AdminUserController::class);
  Route::get('adminuser/{adminuser}/mailedit', 'AdminUserController@mailedit')->name('adminuser.mailedit');
  Route::post('adminuser/sendmail', 'AdminUserController@sendmail')->name('adminuser.sendmail');
  //Route::resourceを使う事により、AdminUserControllerの中のCRUDへのルートを定義する事が出来る。
  Route::resource('user', UserController::class);
  Route::resource('schedule', WorkScheduleController::class);
});
