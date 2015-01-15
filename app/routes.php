<?php

Route::get('/', function()
{
	return Redirect::to('login');
});

Route::get('login', 'SessionController@index');
Route::get('logout', 'SessionController@destroy');

Route::controller('password', 'RemindersController');

Route::resource('session', 'SessionController', [ 'only' => ['index', 'store', 'destroy'] ]);

//
Route::group([ 'before' => 'auth' ], function()
{
	Route::get('dashboard', [ 'as' => 'dashboard', 'uses' => 'HomeController@dashboard' ]);

	Route::resource('users', 'UserController');
	Route::resource('cars', 'CarController');
	Route::resource('clients', 'ClientController');
});
