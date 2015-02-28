<?php namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarStatus;
use App\Models\Client;
use App\Models\ClientStatus;

use Request;

use Illuminate\Contracts\Filesystem\Cloud;

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
		$validation = \Validator::make(Request::all(), [
			'client_id' => 'required|integer',
			'make'      => 'required',
			'model'     => 'required',
			'year'      => 'required|integer',
			'mileage'   => 'required|integer',
		]);

		if ( $validation->fails() ) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		$client_id = Request::get('client_id');
		if ( $client_id == 0 ) {
			$client = $this->create_client();
			$client_id = $client->id;
		}

		if ( ! $client_id ) {
			return redirect()->back()->withInput()->withErrors([ 'client_id' => 'Error assigning client. Please try again.' ]);
		}

		$car = new Car();

		// assign values
		$car->client_id = $client_id;
		$car->make = Request::get('make');
		$car->model = Request::get('model');
		$car->year = Request::get('year');
		$car->vin = Request::get('vin');
		$car->mileage = Request::get('mileage');
		$car->status = CarStatus::ACTIVE;
		$car->save();

		return redirect()->route('cars.show', [ $car->id ])->with('success', 'Car stored successfully.');
	}


	/**
	 * Store a new client to associate for a car.
	 *
 	 * @return Response
	 */
	private function create_client()
	{
		//
		$validation = \Validator::make(Request::all(), [
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|email|unique:clients,email',
		]);

		if ( $validation->fails() ) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		$client = new Client();

		// assign values
		$client->company_name = Request::get('company_name');
		$client->first_name = Request::get('first_name');
		$client->last_name = Request::get('last_name');
		$client->display_name = ( ! empty(Request::get('display_name')) ) ? Request::get('display_name') : ($client->first_name . ' ' . $client->last_name);
		$client->address = Request::get('address');
		$client->city = Request::get('city');
		$client->state = Request::get('state');
		$client->zip = Request::get('zip');
		$client->email = Request::get('email');
		$client->phone = Request::get('phone');
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
	public function show(Cloud $storage, $id)
	{
		//
		$car = Car::find($id);

		return view('cars.show')->with([ 'car' => $car, 'image_exists' => $storage->exists('images/' . $car->id . '.jpg') ]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Cloud $storage, $id)
	{
		//
		$car = Car::find($id);

		$clients = Client::selectRaw('concat(company_name, " ", display_name) as display_name, id')
									->where('status', '=', ClientStatus::ACTIVE)
									->orderBy('company_name', 'asc')
									->orderBy('display_name', 'asc')
									->lists('display_name', 'id');

		$clients_list = [
			'' => 'Select Client',
			0 => 'New Client',
		];
		foreach( $clients as $k => $v ) {
			$clients_list[$k] = $v;
		}

		return view('cars.edit')->with([ 'car' => $car, 'clients' => $clients_list, 'image_exists' => $storage->exists('images/' . $car->id . '.jpg') ]);
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
			'client_id' => 'required|integer',
			'make'      => 'required',
			'model'     => 'required',
			'year'      => 'required|integer',
			'mileage'   => 'required|integer',
		]);

		if ( $validation->fails() ) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		$car = Car::find($id);

		// assign values
		$car->client_id = Request::get('client_id');
		$car->make = Request::get('make');
		$car->model = Request::get('model');
		$car->year = Request::get('year');
		$car->vin = Request::get('vin');
		$car->mileage = Request::get('mileage');
		$car->status = Request::get('status');
		$car->save();

		return redirect()->route('cars.show', [ $car->id ])->with('success', 'Car stored successfully.');
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
	public function image(Cloud $storage, $id)
	{
		//
		if ( $storage->exists('images/' . $id . '.jpg') )
			return \Image::make($storage->get('images/' . $id . '.jpg'))->response();
		else
			return \Image::make(file_get_contents('http://placehold.it/250x250'))->response();
	}


}
