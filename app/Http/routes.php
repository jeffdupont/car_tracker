<?php

Route::get('/', function()
{
	return Redirect::to('login');
});

Route::get('login', 'SessionController@index');
Route::get('logout', 'SessionController@destroy');

// Route::controller('password', 'RemindersController');
Route::controllers([
	// 'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('session', 'SessionController', [ 'only' => ['index', 'store', 'destroy'] ]);

//
Route::group([ 'middleware' => 'auth' ], function()
{
	Route::get('dashboard', [ 'as' => 'dashboard', 'uses' => 'HomeController@dashboard' ]);

	Route::resource('users', 'UserController');
	Route::resource('clients', 'ClientController');

	Route::resource('cars', 'CarController');
	Route::get('cars/{cars}/qrcode', [ 'as' => 'cars.qrcode', 'uses' => 'CarController@qrcode' ]);
	Route::get('cars/{cars}/image', [ 'as' => 'cars.image', 'uses' => 'CarController@image' ]);

	Route::post('cars/{cars}/upload', [ 'as' => 'cars.upload', 'uses' => 'UtilitiesController@upload' ]);

	// Actions
	Route::get('cars/{cars}/actions', [ 'as' => 'cars.actions.index', 'uses' => 'ActionController@index' ]);
	Route::get('cars/{cars}/actions/create', [ 'as' => 'cars.actions.create', 'uses' => 'ActionController@create' ]);
	Route::post('cars/actions', [ 'as' => 'cars.actions.store', 'uses' => 'ActionController@store' ]);
	Route::get('cars/actions/{actions}', [ 'as' => 'cars.actions.show', 'uses' => 'ActionController@show' ]);
	Route::get('cars/actions/{actions}/edit', [ 'as' => 'cars.actions.edit', 'uses' => 'ActionController@edit' ]);
	Route::put('cars/actions/{actions}', [ 'as' => 'cars.actions.update', 'uses' => 'ActionController@update' ]);
	Route::patch('cars/actions/{actions}', [ 'uses' => 'ActionController@update' ]);
	//
});

// hackish
Route::get('dist/css/app.css.map', function() {});