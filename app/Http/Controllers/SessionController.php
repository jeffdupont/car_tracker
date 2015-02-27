<?php namespace App\Http\Controllers;

use Request;


class SessionController extends Controller {


  function index() {

    if (\Auth::user()) {
      return redirect('dashboard');
    }

    return view('session.login');
  }

  function store() {

    if (\Auth::attempt(Request::only('email', 'password'), false)) {

      \Auth::user()->last_login = time();
      \Auth::user()->save();

      return redirect()->intended('dashboard');
    }

    return redirect()->back()->withErrors([ 'validation' => 'Invalid email or password.' ]);
  }

  function destroy() {

    \Auth::logout();

    return redirect('login');
  }

}
