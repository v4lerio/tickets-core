<?php

use Illuminate\Http\Request;

Route::post('/register', 'AuthController@register'); // leave registration open for now
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

// middleware('auth:api');

Route::middleware('auth:api')->group(function() {
    Route::resource('organisations', 'OrganisationController');
    Route::resource('customers', 'CustomerController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('support_types', 'SupportTypeController');
    Route::resource('priorities', 'PriorityController');
    Route::resource('tickets', 'TicketController');
    Route::resource('article', 'ArticleController');
});

