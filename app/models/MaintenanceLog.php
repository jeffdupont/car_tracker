<?php namespace App\Models;

class MaintenanceLog extends \Eloquent {


  function car() {
    return $this->belongsTo('App\Models\Car');
  }

  function user() {
    return $this->belongsTo('App\Models\User');
  }
}
