<?php namespace App\Http\Controllers;

use App\Models\MaintenanceLog;

class HomeController extends Controller {

  function dashboard()
  {
    //
    $notifications = MaintenanceLog::where('is_completed', false)->orderBy('scheduled_at', 'asc');

    return view('home.dashboard')->with([ 'maintenance_logs' => $notifications->paginate(5) ]);
  }

}
