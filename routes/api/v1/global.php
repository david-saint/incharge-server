<?php

/*
|--------------------------------------------------------------------------
| Global Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Global routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Global" middleware group. Enjoy building your Global!
|
*/

Route::group(['namespace' => 'General', 'as' => 'global.'], function () {
	Route::get('/', function () { return 'Hello, World!'; });

	Route::get('contraception-reasons', 'ContraceptionReasonContoroller@index');
	Route::get('contraception-reasons/{reason}', 'ContraceptionReasonContoroller@show');
	Route::get('education-levels', 'EducationLevelsController@index');
	Route::get('faq-groups', 'FaqController@index');
});
