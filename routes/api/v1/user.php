<?php


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "User" middleware group. Enjoy building your User!
|
*/

Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
	Route::post('login', 'Auth\UserAuthController@login')->name('auth.login');
    Route::post('logout', 'Auth\UserAuthController@logout')->name('auth.logout');
    Route::post('register','Auth\UserAuthController@register');
    Route::get('refresh','Auth\UserAuthController@refresh');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
});
