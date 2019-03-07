<?php

use Illuminate\Http\Request;

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::middleware('auth:api')->group(function() {
    Route::post('/refresh', 'AuthController@refresh');
    Route::resource('organisations', 'OrganisationController');
    Route::resource('customers', 'CustomerController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('support_types', 'SupportTypeController');
    Route::resource('priorities', 'PriorityController');
    Route::resource('statuses', 'StatusController');
    Route::resource('tickets', 'TicketController');
    Route::resource('users', 'UserController');
    Route::resource('emails', 'EmailController');
    Route::get('current_user', 'CurrentUserController@show');
    Route::post('tickets/{ticket}/internal_note', 'TicketInternalNoteController@store');
    Route::post('tickets/{ticket}/outbound_email', 'TicketOutboundEmailController@store');
});
