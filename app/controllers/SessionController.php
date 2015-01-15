<?php

class SessionController extends BaseController {


  function index() {

    if (Auth::user()) {
      return Redirect::to('dashboard');
    }

    return View::make('session.login');
  }

  function store() {

    if (Auth::attempt(Input::only('email', 'password'), false)) {

      Auth::user()->last_login = time();
      Auth::user()->save();

      return Redirect::intended('dashboard');
    }

    return Redirect::back()->withErrors([ 'validation' => 'Invalid email or password.' ]);
  }

  function destroy() {

    Auth::logout();

    return Redirect::to('login');
  }
}
