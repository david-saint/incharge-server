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

    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('email/success', 'Auth\VerificationController@success')->name('verification.success');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

    Route::group([ 'middleware' => [ 'user', 'auth' ] ], function () {
        Route::get('', 'Auth\UserAuthController@user')->name('get');

        Route::group(['prefix' => 'clinics', 'as' => 'clinics.'], function () {
            
            /*
             |----------------------------------------------------------------------------
             | Clinic Requests.
             |----------------------------------------------------------------------------
             |
             | This are the routes handling clinic related requests.
            */
            Route::get('', 'ClinicController@index')->name('index');
        });

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            
            /*
             |----------------------------------------------------------------------------
             | Clinic Requests.
             |----------------------------------------------------------------------------
             |
             | This are the routes handling profile related requests.
            */
            Route::post('', 'ProfileController@save')->name('save');
            Route::get('', 'ProfileController@index')->name('index');
        });
    });
});
