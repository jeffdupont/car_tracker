<?php

class HomeController extends \BaseController {

  function dashboard()
  {
    //
    $notifications = [];

    return View::make('home.dashboard')->with([ 'notifications' => $notifications ]);
  }

}
