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
	Route::get('cars/{cars}/scheduled_actions', [ 'as' => 'cars.scheduled_actions', 'uses' => 'CarController@scheduled_actions' ]);

	Route::post('cars/{cars}/upload', [ 'as' => 'cars.upload', 'uses' => 'UtilitiesController@upload' ]);

	// Actions
	Route::get('cars/{cars}/actions', [ 'as' => 'cars.actions', 'uses' => 'ActionController@index' ]);
	Route::get('cars/{cars}/actions/create', [ 'as' => 'cars.actions.create', 'uses' => 'ActionController@create' ]);
	Route::post('cars/actions', [ 'as' => 'cars.actions.store', 'uses' => 'ActionController@store' ]);
	Route::get('cars/actions/{actions}', [ 'as' => 'cars.actions.show', 'uses' => 'ActionController@show' ]);
	Route::get('cars/actions/{actions}/edit', [ 'as' => 'cars.actions.edit', 'uses' => 'ActionController@edit' ]);
	Route::put('cars/actions/{actions}', [ 'as' => 'cars.actions.update', 'uses' => 'ActionController@update' ]);
	Route::patch('cars/actions/{actions}', [ 'uses' => 'ActionController@update' ]);
	Route::get('cars/actions/{actions}/complete', [ 'as' => 'cars.actions.complete', 'uses' => 'ActionController@complete' ]);
	//

	// Scheduled Actions
	Route::get('cars/{cars}/scheduled_actions', [ 'as' => 'cars.scheduled_actions', 'uses' => 'ScheduledActionController@index' ]);
	Route::get('cars/{cars}/scheduled_actions/create', [ 'as' => 'cars.scheduled_actions.create', 'uses' => 'ScheduledActionController@create' ]);
	Route::post('cars/scheduled_actions', [ 'as' => 'cars.scheduled_actions.store', 'uses' => 'ScheduledActionController@store' ]);
	Route::get('cars/scheduled_actions/{scheduled_actions}', [ 'as' => 'cars.scheduled_actions.show', 'uses' => 'ScheduledActionController@show' ]);
	Route::get('cars/scheduled_actions/{scheduled_actions}/edit', [ 'as' => 'cars.scheduled_actions.edit', 'uses' => 'ScheduledActionController@edit' ]);
	Route::put('cars/scheduled_actions/{scheduled_actions}', [ 'as' => 'cars.scheduled_actions.update', 'uses' => 'ScheduledActionController@update' ]);
	Route::patch('cars/scheduled_actions/{scheduled_actions}', [ 'uses' => 'ScheduledActionController@update' ]);
	//
});

// hackish
Route::get('dist/css/app.css.map', function() {});
