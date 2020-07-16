<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\AuthController@register');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource('deposit', 'DepositController');
Route::get('donation/get_donations_by_user/{id}', 'DonationController@get_donations_by_user');
Route::resource('donation', 'DonationController');
Route::resource('org', 'OrgController');

Route::get('/balance/{id}', 'BalanceController@get_user_balance');
