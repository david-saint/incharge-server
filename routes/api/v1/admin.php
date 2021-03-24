<?php


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Admin" middleware group. Enjoy building your Admin!
|
*/

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
	Route::resource('', 'AdminController');
	Route::get('loginView', 'AdminController@loginView');
	Route::get('panel', 'AdminController@panel')->middleware('auth');
	Route::get('getAdminDet', 'AdminController@getAdminDet')->middleware('auth');
	Route::get('logout', 'AdminController@logout');	
	// Route::get('algo', 'AdminController@algo');	
	Route::post('login', 'AdminController@login');
	Route::resource('algo', 'AlgorithmController')->middleware('auth');
	Route::get('algorithm', 'AlgorithmController@algoJSON')->middleware('auth');
});
