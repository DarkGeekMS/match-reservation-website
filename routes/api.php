<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.verify']], function () {

    // Customer User
    Route::post('/UpdatePreferences', 'CustomerController@updatePrefs');
    Route::get('/GetPreferences', 'CustomerController@getPrefs');
    Route::post('/ChangePassword', 'CustomerController@changePassword');
    Route::post('/MakeReservation', 'CustomerController@makeReservation');
    Route::delete('/CancelReservation', 'CustomerController@cancelReservation');
    Route::get('/GetReservations', 'CustomerController@getReservations');
    
    // administration

    Route::post('/ApproveUser', 'AdminController@approveUser');
    Route::delete('/DeleteUser', 'AdminController@deleteUser');
    Route::get('/GetUsers', 'AdminController@getCurretUsers');
    Route::get('/GetWaittingUsers', 'AdminController@getPinnedUsers');

    // EFA Managers

    Route::post('/CreateMatch', 'EFAManagerController@createMatch');
    Route::post('/UpdateMatch', 'EFAManagerController@editMatch');
    Route::post('/CreateStadium', 'EFAManagerController@createStadium');
    Route::get('/ViewStadiums', 'EFAManagerController@getStaduims');

    // General
    Route::post('/SignOut', 'GeneralController@logout');

});

// Guest user
Route::post('/SignUp', 'GuestController@signUp');
Route::post('/SignIn', 'GuestController@login');

// General
Route::get('/MatchsDetails', 'GeneralController@matchDetails');
Route::get('/MatchReservationDetails', 'GeneralController@getReservations');
