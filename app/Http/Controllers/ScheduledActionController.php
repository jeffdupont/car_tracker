<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\ScheduledAction;

use Request;

use Illuminate\Contracts\Filesystem\Cloud;
use Recur\Recur;


class ScheduledActionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index( Cloud $storage, $car_id = false )
	{
		//
		$car = Car::find($car_id);

		return view('scheduled_actions.index')->with([ 'car' => $car, 'image_exists' => $storage->exists('images/' . $car->id . '.jpg') ]);
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

		return view('scheduled_actions.create')->with([ 'car' => $car ]);
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
			'car_id' 	 => 'required|integer',
			'action' 	 => 'required',
			'type' 	   => 'required',
			'timezone' => 'required',
		]);

		if ( $validation->fails() ) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		$recur = $this->get_recur_options();

		$scheduled_action = new ScheduledAction();

		// assign values
		$scheduled_action->car_id = Request::get('car_id');
		$scheduled_action->action = Request::get('action');
		$scheduled_action->details = Request::get('details');
		$scheduled_action->type = Request::get('type');
		$scheduled_action->scheduled_at = json_encode($recur->save());
		$scheduled_action->save();

		return redirect()->route('cars.scheduled_actions', [ Request::get('car_id') ])->with('success', 'Action stored successfully.');
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
		$scheduled_action = ScheduledAction::find($id);

		// return [ $scheduled_action->day ];

		return view('scheduled_actions.edit')->with([ 'scheduled_action' => $scheduled_action, 'car' => $scheduled_action->car ]);
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
		$validation = \Validator::make(Request::all(), [
			'car_id' 	 => 'required|integer',
			'action' 	 => 'required',
			'type' 	   => 'required',
			'timezone' => 'required',
		]);

		if ( $validation->fails() ) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		$recur = $this->get_recur_options();

		// return [ Request::all(), $recur->save() ];

		$scheduled_action = ScheduledAction::find($id);

		// assign values
		$scheduled_action->car_id = Request::get('car_id');
		$scheduled_action->action = Request::get('action');
		$scheduled_action->details = Request::get('details');
		$scheduled_action->type = Request::get('type');
		$scheduled_action->scheduled_at = json_encode($recur->save());
		$scheduled_action->save();

		return redirect()->route('cars.scheduled_actions.edit', [ $scheduled_action->id ])->with('success', 'Action updated successfully.');
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
    $scheduled_action = ScheduledAction::find($id);
    $scheduled_action->is_active = false;
    $scheduled_action->save();

    return redirect()->route('cars.scheduled_actions', [ $scheduled_action->car_id ])->with('success', 'Action updated successfully.');
	}


	private function get_recur_options()
	{
		//
		$type = Request::get('type');
		$timezone = Request::get('timezone');

		$recur = Recur::create();
		$recur->tz = $timezone;

		switch( $type ) {
			case "daily":
				if ( Request::get('repeat') == 'week_day' ) {
					$recur->every([ 'mon', 'tue', 'wed', 'thu', 'fri' ], 'daysOfWeek');
				}
				if ( Request::get('repeat') == 'every_day' ) {
					$recur->every( 1, 'days');
				}
				break;

			case "weekly":
				$recur->every( Request::get('repeat_days'), 'daysOfWeek' );
				break;

			case "biweekly":
				$start_date = Request::get('start_date');
				$recur->start($start_date)->every( Request::get('repeat_days'), 'daysOfWeek' )->every( 2, 'weeks' );
				break;

			case "monthly":
			  $recur->every( Request::get('day'), 'daysOfMonth' );
				break;

			case "quarterly":
				$from_date = Request::get('start_date');
				$start_date = \Carbon\Carbon::now()->day(Request::get('day'));
			  $recur->start($start_date)->from($from_date)->every( 3, 'months' );
				break;

			case "yearly":
				$start_date = Request::get('start_date');
			  $recur->start($start_date)->every( 1, 'year' );
				break;
		}

		return $recur;
	}

}
