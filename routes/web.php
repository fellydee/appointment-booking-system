<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('/admin', 'AdminController@index');

Route::get('/employees', 'EmployeeController@index');
Route::get('/employees/create', 'EmployeeController@create');
Route::get('/employees/edit', 'EmployeeController@edit');
Route::post('/employees', 'EmployeeController@store');


// temporary
Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});
