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

// Routes for ADMIN AUTH
Route::get('/loginView', 'AdminController@loginView');
Route::get('/logout', 'AdminController@logout');	
Route::post('/login', 'AdminController@login');
Route::get('/panel', 'AdminController@panel');

// Routes for managing sub-admins on the admin panel
Route::resource('/admin', 'AdminController');
Route::get('/allAdmins', 'AdminController@allAdmins');
Route::get('/getAdminDet', 'AdminController@getAdminDet');
Route::put('updateAdmin/{admin_id}', 'AdminController@update');

// Routes for managing Algorithm on the admin panel
Route::resource('/algo', 'AlgorithmController');

//Routes for managing users
Route::get('/getUsers', 'AdminController@allUsers');
Route::put('updateUser/{user_id}', 'AdminController@updateUser');
Route::delete('deleteUser/{user_id}', 'AdminController@deleteUser');
Route::get('/getDeletedUsers', 'AdminController@deletedUsers');
Route::put('revertDeletedUser/{user_id}', 'AdminController@revertDeletedUser');

//Routes for managing clinics
Route::get('/getClinics', 'AdminController@allClinics');
Route::post('addClinic', 'AdminController@addClinic');
Route::put('updateClinic/{clinic_id}', 'AdminController@updateClinic');
Route::delete('deleteClinic/{user_id}', 'AdminController@deleteClinic');
Route::get('/getDeletedClinics', 'AdminController@deletedClinics');
Route::put('revertDeletedClinic/{clinic_id}', 'AdminController@revertDeletedClinic');

//Routes for managing Contraception Reason
Route::get('/getContraceptionReason', 'AdminController@contraceptionReason');

//Routes for managing Educational Levels
Route::get('/getEducationalLevels', 'AdminController@educationalLevels');