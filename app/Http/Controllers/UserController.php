<?php namespace App\Http\Controllers;

use App\Models;
use App\Models\User;
use App\Models\UserStatus;
use Request;
use Hash;

class UserController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  function index()
  {
    //
    $users = User::where('status', '=', UserStatus::ACTIVE)->orderBy('last_name', 'asc');

    return view('users.index')->with([ 'users' => $users->paginate(25), 'filter' => [] ]);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
    return view('users.create');
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
      'email'      => 'required|email|unique:users,email',
      'password'   => 'required|min:8',
      'verify'     => 'required|same:password'
    ]);

    if ( $validation->fails() ) {
      return redirect()->back()->withInput()->withErrors($validation);
    }

    $user = new User();

    // assign values
    $user->first_name = Request::get('first_name');
    $user->last_name = Request::get('last_name');
    $user->display_name = ( ! empty(Request::get('display_name')) ) ? Request::get('display_name') : ($user->first_name . ' ' . $user->last_name);
    $user->email = Request::get('email');
    $user->password = Hash::make(Request::get('password'));
    $user->is_admin = Request::get('is_admin', false);
    $user->status = Request::get('status', false);
    $user->save();

    return redirect()->route('users.show', [ $user->id ])->with('success', 'User created successfully.');
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
    $user = User::find($id);

    return view('users.show')->with([ 'user' => $user ]);
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
    $user = User::find($id);

    return view('users.edit')->with([ 'user' => $user ]);
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
      'email'      => 'required|email|unique:users,email,' . $id,
    ]);

    $validation->sometimes('password', 'required|min:8', function($input)
    {
      return Request::get('password');
    });
    $validation->sometimes('verify', 'required|min:8|same:password', function($input)
    {
      return Request::get('password');
    });

    if ( $validation->fails() ) {
      return redirect()->back()->withInput()->withErrors($validation);
    }

    $user = User::find($id);

    // assign values
    $user->first_name = Request::get('first_name');
    $user->last_name = Request::get('last_name');
    $user->display_name = ( ! empty(Request::get('display_name')) ) ? Request::get('display_name') : ($user->first_name . ' ' . $user->last_name);
    $user->email = Request::get('email');
    $user->is_admin = Request::get('is_admin', false);
    $user->status = Request::get('status', false);

    if ( Request::get('password') ) {
      $user->password = Hash::make(Request::get('password'));
    }

    $user->save();

    return redirect()->route('users.show', [ $user->id ])->with('success', 'User has been updated successfully.');
  }


}
