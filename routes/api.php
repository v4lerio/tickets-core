<?php

use Illuminate\Http\Request;

Route::post('/register', 'AuthController@register'); // leave registration open for now
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

// middleware('auth:api');

Route::middleware('auth:api')->group(function() {
    Route::resource('organisations', 'OrganisationController');
    Route::resource('customers', 'CustomerController');
});

