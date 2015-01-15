<?php

class HomeController extends \BaseController {

  function dashboard()
  {
    //
    $notifications = MaintenanceLog::orderBy('created_at', 'desc');

    return View::make('home.dashboard')->with([ 'notifications' => $notifications->paginate(25) ]);
  }

}
