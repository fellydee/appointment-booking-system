<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});
