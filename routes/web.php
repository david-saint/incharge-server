<?php
use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Route::get('/privacy', function () {
	return view('privacy-policy');
});
Route::get('/loginView', 'AdminController@loginView');
Route::get('/logout', 'AdminController@logout');	
Route::post('/login', 'AdminController@login');

Route::resource('/admin', 'AdminController');
Route::get('/allAdmins', 'AdminController@allAdmins');
Route::get('/panel', 'AdminController@panel');
Route::get('/getAdminDet', 'AdminController@getAdminDet');
Route::put('updateAdmin/{admin_id}', 'AdminController@update');

Route::get('/getUsers', 'AdminController@allUsers');
Route::get('/education-levels', 'AdminController@eduLevel');
Route::get('/contraception-reasons', 'AdminController@contraceptionReasons');
Route::put('revertDeletedUser/{user_id}', 'AdminController@revertDeletedUser');
Route::get('/deletedUser', 'AdminController@deletedUser');
Route::delete('/deleteUser/{user_id}', 'AdminController@deleteUser');

Route::get('/getClinics', 'AdminController@allClinics');
Route::post('addClinic', 'AdminController@addClinic');
Route::put('/updateClinics/{clinic_id}', 'AdminController@updateClinic');
Route::get('/deletedClinics', 'AdminController@deletedClinics');
Route::put('revertDeletedClinic/{user_id}', 'AdminController@revertDeletedClinic');
Route::delete('/deleteClinic/{clinic_id}', 'AdminController@deleteClinic');

Route::resource('/algo', 'AlgorithmController');

