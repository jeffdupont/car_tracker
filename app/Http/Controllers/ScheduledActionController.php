<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Car;

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
				$recur->every( Request::get('repeat'), 'daysOfWeek' );
				break;

			case "biweekly":
				$start_date = Request::get('start_date');
				$recur->start($start_date)->every( 2, 'weeks' );
				break;

			case "monthly":
			  $recur->every( Request::get('day'), 'daysOfMonth' );
				break;

			case "quarterly":
				$start_date = Request::get('start_date');
			  $recur->start($start_date)->every( 3, 'months' );
				break;

			case "yearly":
				$start_date = Request::get('start_date');
			  $recur->start($start_date)->every( 1, 'year' );
				break;
		}

		return [ Request::all(), $recur->save() ];
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
