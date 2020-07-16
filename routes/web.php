<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/org', 'OrgController@index');

Route::resource('org', 'OrgController');
Route::resource('donation', 'DonationController');
