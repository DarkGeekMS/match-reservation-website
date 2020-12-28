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
    Route::post('/GetPreferences', 'CustomerController@getPrefs');
    Route::post('/ChangePassword', 'CustomerController@changePassword');
    Route::post('/MakeReservation', 'CustomerController@makeReservation');
    Route::post('/CancelReservation', 'CustomerController@cancelReservation');


    // administration

    Route::post('/ApproveUser', 'AdminController@approveUser');
    Route::delete('/DeleteUser', 'AdminController@deleteUser');


    // EFA Managers

    Route::post('/BlockUser', 'EFAManagerController@block');
    Route::post('/UserData', 'EFAManagerController@userData');
    Route::post('/CreateMatch', 'EFAManagerController@createMatch');
    Route::post('/CreateStadium', 'EFAManagerController@createStadium');
    Route::post('/ViewMatches', 'EFAManagerController@viewMatch');
    Route::post('/ViewStadium', 'EFAManagerController@viewStadium');

    // General
    Route::post('/SignOut', 'GeneralController@logout');



});

// Guest user
Route::post('/SignUp', 'GuestController@signUp');
Route::post('/SignIn', 'GuestController@login');

// General
Route::get('/MatchsDetails', 'GeneralController@matchDetails');
