<?php

Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('/admin', 'AdminController@index');

Route::resource('/employees', 'EmployeeController');

Route::resource('/rosters', 'RosterController', ['only' => [
    'create', 'store', 'update', 'destroy', 'edit',
]]);

// temporary
Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});
