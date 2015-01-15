<?php

class ClientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return View::make('clients.create');
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

		return Redirect::route('clients.show', $client->id)->with('success', 'Client created successfully.');
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
