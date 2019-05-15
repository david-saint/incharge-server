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
	Route::get('/', function () {
		return 'Hello, World!';
	});
});
