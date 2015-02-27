<?php namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarStatus;
use App\Models\Client;

class CarController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$cars = Car::where('status', '=', CarStatus::ACTIVE)->orderBy('created_at', 'desc');

		return view('cars.index')->with([ 'cars' => $cars->paginate(25), 'filter' => [] ]);
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

		return view('cars.create')->with([ 'clients' => $clients ]);
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
			'mileage'   => 'required|integer',
		]);

		if ( $validation->fails() ) {
			return Redirect::back()->withInput()->withErrors($validation);
		}

		$client_id = Input::get('client_id');
		if ( $client_id == 0 ) {
			$client = $this->create_client();
			$client_id = $client->id;
		}

		if ( ! $client_id ) {
			return Redirect::back()->withInput()->withErrors([ 'client_id' => 'Error assigning client. Please try again.' ]);
		}

		$car = new Car();

		// assign values
		$car->client_id = $client_id;
		$car->make = Input::get('make');
		$car->model = Input::get('model');
		$car->year = Input::get('year');
		$car->vin = Input::get('vin');
		$car->mileage = Input::get('mileage');
		$car->status = CarStatus::ACTIVE;
		$car->save();

		return Redirect::route('cars.show', $car->id)->with('success', 'Car stored successfully.');
	}


	/**
	 * Store a new client to associate for a car.
	 *
 	 * @return Response
	 */
	private function create_client()
	{
		//
		$validation = Validator::make(Input::all(), [
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|email|unique:clients,email',
		]);

		if ( $validation->fails() ) {
			return Redirect::back()->withInput()->withErrors($validation);
		}

		$client = new Client();

		// assign values
		$client->company_name = Input::get('company_name');
		$client->first_name = Input::get('first_name');
		$client->last_name = Input::get('last_name');
		$client->display_name = ( ! empty(Input::get('display_name')) ) ? Input::get('display_name') : ($client->first_name . ' ' . $client->last_name);
		$client->address = Input::get('address');
		$client->city = Input::get('city');
		$client->state = Input::get('state');
		$client->zip = Input::get('zip');
		$client->email = Input::get('email');
		$client->phone = Input::get('phone');
		$client->status = ClientStatus::ACTIVE;
		$client->save();

		return $client;
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
		$car = Car::find($id);

		return view('cars.show')->with([ 'car' => $car ]);
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
		$car = Car::find($id);

		$clients = Client::selectRaw('concat(company_name, " ", display_name) as display_name, id')
									->where('status', '=', ClientStatus::ACTIVE)
									->orderBy('company_name', 'asc')
									->orderBy('display_name', 'asc')
									->lists('display_name', 'id');


		return view('cars.edit')->with([ 'car' => $car, 'clients' => $clients ]);
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
		$validation = Validator::make(Input::all(), [
			'client_id' => 'required|integer',
			'make'      => 'required',
			'model'     => 'required',
			'year'      => 'required|integer',
			'mileage'   => 'required|integer',
		]);

		if ( $validation->fails() ) {
			return Redirect::back()->withInput()->withErrors($validation);
		}

		$car = Car::find($id);

		// assign values
		$car->client_id = Input::get('client_id');
		$car->make = Input::get('make');
		$car->model = Input::get('model');
		$car->year = Input::get('year');
		$car->vin = Input::get('vin');
		$car->mileage = Input::get('mileage');
		$car->status = Input::get('status');
		$car->save();

		return Redirect::route('cars.show', $car->id)->with('success', 'Car stored successfully.');
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
	 * Displays the QR Code associated with the resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function qrcode($id)
	{
		//
		$car = Car::find($id);

		// generate the QR code
		$qr_image = '/tmp/qrcode_' . $car->id . '.png';
		\PHPQRCode\QRcode::png($car->generate_qr_content(), $qr_image, 'H', 10, 1);

		// base64 encode image
		$binary = fread(fopen($qr_image, "r"), filesize($qr_image));
		$base64 = base64_encode($binary);

		return view('cars.qrcode')->with([ 'car' => $car, 'qr_image_64' => $base64 ]);
	}


	/**
 	 * Displays the image associated with the resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function image($id)
	{
		//
		return Image::make(storage_path() . Config::get('upload.path') . '/' . $id . '.jpg')->response();
	}


}
