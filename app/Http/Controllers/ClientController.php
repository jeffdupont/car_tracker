<?php namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientStatus;
use Request;

class ClientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$clients = Client::where('status', '=', ClientStatus::ACTIVE)->orderBy('created_at', 'desc');

		return view('clients.index')->with([ 'clients' => $clients->paginate(25), 'filter' => [] ]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('clients.create');
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

		return redirect()->route('clients.show', [ $client->id ])->with('success', 'Client created successfully.');
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
		$client = Client::find($id);

		return view('clients.show')->with([ 'client' => $client ]);
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
		$client = Client::find($id);

		return view('clients.edit')->with([ 'client' => $client ]);
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
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|email|unique:clients,email,' . $id,
		]);

		if ( $validation->fails() ) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		$client = Client::find($id);

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
		// $client->status = ClientStatus::ACTIVE;
		$client->save();

		return redirect()->route('clients.show', [ $client->id ])->with('success', 'Client has been updated successfully.');
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
