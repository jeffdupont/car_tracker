<?php namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\MaintenanceLog;

use Request;

class ActionController extends Controller {

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

		return view('actions.create')->with([ 'car' => $car, 'log' => new MaintenanceLog() ]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$validation = \Validator::make(Request::all(), [
			'car_id' => 'required',
			'action' => 'required'
		]);

		if ( $validation->fails() ) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		// get the car
		$car = Car::find(Request::get('car_id'));

		// validate the ending mileage is > starting mileage
		if ( Request::get('ending_mileage') && $car->mileage > Request::get('ending_mileage') ) {
			return redirect()->back()->withInput()->withErrors([ 'validation' => 'The ending mileage is less than the starting mileage.' ]);
		}

		// maintenance log
		$log = new MaintenanceLog();
		$log->user_id = \Auth::user()->id;
		$log->car_id = $car->id;
		$log->additional_data = json_encode([
			'description' => Request::get('description'),
			'mileage' => [
				'start' => $car->mileage,
				'end'   => Request::get('ending_mileage') ? Request::get('ending_mileage') : $car->mileage
			]
		]);
		$log->action = $this->get_action(Request::get('action'));
		$log->is_completed = true;
		$log->completed_at = $log->scheduled_at = \Carbon\Carbon::now();
		$log->save();

		// update the mileage on the car
		if ( Request::get('ending_mileage') ) {
			$car->mileage = Request::get('ending_mileage');
			$car->save();
		}

		return redirect()->route('cars.show', [ $car->id ])->with('success', 'Action logged successfully.');
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
		$log = MaintenanceLog::find($id);
		$car = $log->car;

		// validate the ending mileage is > starting mileage
		if ( Request::get('ending_mileage') && $car->mileage > Request::get('ending_mileage') ) {
			return redirect()->back()->withInput()->withErrors([ 'validation' => 'The ending mileage is less than the starting mileage.' ]);
		}

		// mark it completed
		$log->additional_data = json_encode([
			'description' => Request::get('description'),
			'mileage' => [
				'start' => $car->mileage,
				'end'   => Request::get('ending_mileage') ? Request::get('ending_mileage') : $car->mileage
			]
		]);
		$log->is_completed = true;
		$log->completed_at = \Carbon\Carbon::now();
		$log->user_id = \Auth::user()->id;
		$log->save();

		// update the mileage on the car
		if ( Request::get('ending_mileage') ) {
			$car->mileage = Request::get('ending_mileage');
			$car->save();
		}

		return redirect()->route('cars.show', [ $car->id ])->with('success', 'Action completed successfully.');
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


	/**
	 * Mark the action as completed.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function complete($id)
	{
		//
		$log = MaintenanceLog::find($id);

		return view('actions.complete')->with([ 'car' => $log->car, 'log' => $log ]);
	}
}
