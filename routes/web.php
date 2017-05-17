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
  Route::resource('/schedule', 'WorkScheduleController', ['except' => 'show']);
  Route::post('/register', 'Auth\RegisterController@register');
  Route::get('/register/{query}', 'Auth\RegisterController@showRegistrationForm');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
  Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
  Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
  Route::post('logout', 'Auth\LoginController@logout');

  Route::get('/', 'HomeController@index');
  Route::resource('report', DailyReportController::class, ['only' => ['index', 'show']]);
  Route::resource('store', StoreController::class);

  Route::resource('adminuser', AdminUserController::class);
  Route::get('adminuser/{adminuser}/mailedit', ['as' => 'adminuser.mailedit', 'AdminUserController@mailedit']);
  Route::post('adminuser/sendmail', ['as' => 'adminuser.sendmail', 'uses' => 'AdminUserController@sendmail']);
  Route::resource('user', 'UserController');
  Route::POST('password/email',['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
  Route::GET('password/reset',['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
  Route::POST('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ResetPasswordController@reset']);
  Route::GET('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

  Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AdminRegisterController@adminRegister']);
  Route::get('/register/', 'Auth\AdminRegisterController@showAdminRegistrationForm');

  Route::resource('user', UserController::class);
  Route::resource('schedule', WorkScheduleController::class, ['only' => 'index']);
});
