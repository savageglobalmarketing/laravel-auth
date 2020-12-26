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
    Route::get('user', 'UserController@loggedUser')->name('savageglobalmarketing.user');
    Route::get('email/resend', 'VerificationController@resend')->name('savageglobalmarketing.verification.resend');
    Route::post('logout', 'AuthController@revokeToken')->middleware('auth:api')->name('savageglobalmarketing.logout');
    Route::apiResource('users', 'UserController', ['as' => 'savageglobalmarketing']);
    Route::apiResource('tenants', 'TenantController', ['as' => 'savageglobalmarketing']);
});

// Open routes
Route::group(['middleware' => 'api'], function () {
    Route::post('login', 'AuthController@login')->name('savageglobalmarketing.login');

    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{uuid}', 'VerificationController@verify')->name('verification.verify')->middleware(['auth:api']);

    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('savageglobalmarketing.password.email');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('savageglobalmarketing.password.update');
    Route::post('register', 'RegisterController@register')->name('savageglobalmarketing.register');
});



