<?php

Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('/admin', 'AdminController@index');

Route::resource('/employees', 'EmployeeController');

Route::resource('/rosters', 'RosterController', ['only' => [
    'create', 'store', 'update', 'destroy', 'edit',
]]);

Route::resource('/hours', 'HoursController', ['only' => ['index', 'store']]);

// temporary
Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::resource('/booking', 'BookingController');

Route::resource('/services', 'ServiceController');
Route::post('/services/assign', 'ServiceController@assign');
Route::post('/services/unassign', 'ServiceController@unassign');
