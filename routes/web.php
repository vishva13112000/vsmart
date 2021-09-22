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
    return redirect()->route('login');
});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'employee'], function () {
  Route::get('/login', 'EmployeeAuth\LoginController@showLoginForm')->name('employee.login');
  Route::post('/login', 'EmployeeAuth\LoginController@login');
  Route::post('/logout', 'EmployeeAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'EmployeeAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'EmployeeAuth\RegisterController@register');

  Route::post('/password/email', 'EmployeeAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'EmployeeAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'EmployeeAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'EmployeeAuth\ResetPasswordController@showResetForm');
});



Route::group(['prefix' => 'shop'], function () {
  Route::get('/login', 'ShopAuth\LoginController@showLoginForm')->name('shop.login');
  Route::post('/login', 'ShopAuth\LoginController@login');
  Route::post('/logout', 'ShopAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'ShopAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'ShopAuth\RegisterController@register');

  Route::post('/password/email', 'ShopAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'ShopAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'ShopAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'ShopAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'deliveryman'], function () {
  Route::get('/login', 'DeliverymanAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'DeliverymanAuth\LoginController@login');
  Route::post('/logout', 'DeliverymanAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'DeliverymanAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'DeliverymanAuth\RegisterController@register');

  Route::post('/password/email', 'DeliverymanAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'DeliverymanAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'DeliverymanAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'DeliverymanAuth\ResetPasswordController@showResetForm');
});
