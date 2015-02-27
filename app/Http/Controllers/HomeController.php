<?php namespace App\Http\Controllers;

use App\Models;

class HomeController extends Controller {

  function dashboard()
  {
    //
    $notifications = MaintenanceLog::orderBy('created_at', 'desc');

    return view('home.dashboard')->with([ 'notifications' => $notifications->paginate(25) ]);
  }

}
