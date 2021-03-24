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

Route::group(['namespace' => 'User', 'as' => 'user.'], function ()
{
    Route::post('register','Auth\UserAuthController@register');
	Route::post('login', 'Auth\UserAuthController@login')->name('auth.login');
    Route::post('logout', 'Auth\UserAuthController@logout')->name('auth.logout');

    
    Route::get('refresh','Auth\UserAuthController@refresh');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('email/success', 'Auth\VerificationController@success')->name('verification.success');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');



    Route::group(['prefix' => 'clinics', 'as' => 'clinics.'], function ()
    {
        
        /*
         |----------------------------------------------------------------------------
         | Clinic Requests.
         |----------------------------------------------------------------------------
         |
         | This are the routes handling clinic related requests.
        */
        Route::get('', 'ClinicController@index')->name('index');

        Route::get('/getClinics', 'ClinicController@getClinics')->name('getClinics');
        Route::get('/deletedClinics', 'ClinicController@deletedClinic')->name('deletedClinic');
        Route::put('/update/{clinic_id}', 'ClinicController@update')->name('update');
        Route::put('/revertDelete/{clinic_id}', 'ClinicController@revertDelete')->name('revertDelete');        
        Route::post('/addClinic', 'ClinicController@store')->name('store');
        Route::delete('/deleteClinic/{clinic_id}', 'ClinicController@destroy')->name('deleteClinics');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function ()
    {
        
        /*
         |----------------------------------------------------------------------------
         | Clinic Requests.
         |----------------------------------------------------------------------------
         |
         | This are the routes handling clinic related requests.
        */
        Route::get('', 'UsersController@index')->name('users');
        Route::get('/deletedUser', 'UsersController@deletedUser')->name('deletedUser');
        Route::put('/update/{user_id}', 'UsersController@update')->name('update');
        // reactivateUser
        Route::delete('/deleteUser/{user_id}', 'UsersController@destroy')->name('deleteUsers');
    });



    Route::group([ 'middleware' => [ 'user', 'auth' ] ], function ()
    {
        Route::get('', 'Auth\UserAuthController@user')->name('get');

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function ()
        {
            
            /*
             |----------------------------------------------------------------------------
             | Profile Requests.
             |----------------------------------------------------------------------------
             |
             | This are the routes handling profile related requests.
            */
            Route::post('', 'ProfileController@save')->name('save');
            Route::get('', 'ProfileController@index')->name('index');
            Route::post('algorithm', 'ProfileController@setAlgorithmPlan')->name('set_algorithm_plan');
        });
    });
});
