<?php

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


// Authenticated routes
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'UserController@loggedUser')->name('maxcelos.user');
    Route::get('email/resend', 'VerificationController@resend')->name('maxcelos.verification.resend');
    Route::post('logout', 'AuthController@revokeToken')->middleware('auth:api')->name('maxcelos.logout');
    Route::apiResource('users', 'UserController', ['as' => 'maxcelos']);
});

// Open routes
Route::group(['middleware' => 'api'], function () {
    Route::post('login', 'AuthController@login')->name('maxcelos.login');

    Route::get('email/verify', 'VerificationController@show')->name('maxcelos.verification.notice');
    Route::get('email/verify/{uuid}', 'VerificationController@verify')->name('maxcelos.verification.verify');

    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('maxcelos.password.email');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('maxcelos.password.update');
});
