<?php

class ActionController extends \BaseController {

	/**
	 * Display a listing of the resource.
   * TODO: at some point maybe handle passing no car_id and just
	 *       display ALL actions against ALL cars
	 *
	 * @return Response
	 */
	public function index( $car_id = false )
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create( $car_id = false )
	{
		//
		$car = Car::find($car_id);

		return View::make('actions.create')->with([ 'car' => $car ]);
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
			'car_id' => 'required',
			'action' => 'required'
		]);

		if ( $validation->fails() ) {
			return Redirect::back()->withInput()->withErrors($validation);
		}

		// get the car
		$car = Car::find(Input::get('car_id'));

		// validate the ending mileage is > starting mileage
		if ( Input::get('ending_mileage') && $car->mileage > Input::get('ending_mileage') ) {
			return Redirect::back()->withInput()->withErrors([ 'validation' => 'The ending mileage is less than the starting mileage.' ]);
		}

		// maintenance log
		$log = new MaintenanceLog();
		$log->user_id = Auth::user()->id;
		$log->car_id = $car->id;
		$log->additional_data = json_encode([
			'description' => Input::get('description'),
			'mileage' => [
				'start' => $car->mileage,
				'end'   => Input::get('ending_mileage') ? Input::get('ending_mileage') : $car->mileage
			]
		]);
		$log->action = $this->get_action(Input::get('action'));
		$log->save();

		// update the mileage on the car
		if ( Input::get('ending_mileage') ) {
			$car->mileage = Input::get('ending_mileage');
			$car->save();
		}

		return Redirect::route('cars.show', $car->id)->with('success', 'Action logged successfully.');
	}


	private function get_action( $action_id ) {
		//
		switch($action_id) {
			case 2:
			case 'test_drive':
				return 'Test Drive';
				break;

			case 1:
			case 'maintenance':
				return 'Maintenance';
				break;

			case 0:
			case 'start_car':
				return 'Start Car';
				break;
		}
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
