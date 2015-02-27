<?php namespace App\Http\Controllers;

use App\Models\MaintenanceLog;

class HomeController extends Controller {

  function dashboard()
  {
    //
    $notifications = MaintenanceLog::orderBy('created_at', 'desc');

    return view('home.dashboard')->with([ 'maintenance_logs' => $notifications->paginate(25) ]);
  }

}
