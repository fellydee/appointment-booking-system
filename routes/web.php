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

Route::get('/booking', 'BookingController@index');
Route::get('/booking/service/{id}', 'BookingController@showService');
Route::get('/booking/service/{service_id}/employee/{employee_id}', 'BookingController@showEmployee');
Route::post('/booking', 'BookingController@processBooking');
Route::post('/booking/customer', 'BookingController@setCustomer');
Route::get('/viewBooking/{id}','\App\Http\Controllers\BookingController@viewBooking');

Route::resource('/services', 'ServiceController');
Route::post('/services/assign', 'ServiceController@assign');
Route::post('/services/unassign', 'ServiceController@unassign');
