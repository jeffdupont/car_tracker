<?php

class CarController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$cars = Car::where('status', '=', CarStatus::ACTIVE)->orderBy('created_at', 'desc');

		return View::make('cars.index')->with([ 'cars' => $cars->paginate(25), 'filter' => [] ]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// get the list of accounts
		$clients = Client::selectRaw('concat(company_name, " ", display_name) as display_name, id')
									->where('status', '=', ClientStatus::ACTIVE)
									->orderBy('company_name', 'asc')
									->orderBy('display_name', 'asc')
									->lists('display_name', 'id');

		return View::make('cars.create')->with([ 'clients' => $clients ]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$validation = Validator::make(Input::all(), [
			'client_id' => 'required|integer',
			'make'      => 'required',
			'model'     => 'required',
			'year'      => 'required|integer',
		]);

		if ( $validation->fails() ) {
			return Redirect::back()->withInput()->withErrors($validation);
		}

		$car = new Car();

		// assign values
		$car->client_id = Input::get('client_id');
		$car->make = Input::get('make');
		$car->model = Input::get('model');
		$car->year = Input::get('year');
		$car->vin = Input::get('vin');
		$car->status = CarStatus::ACTIVE;
		$car->save();

		return Redirect::route('cars.show', $car->id)->with('success', 'Car stored successfully.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}