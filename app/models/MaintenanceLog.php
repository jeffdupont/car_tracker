<?php

class MaintenanceLog extends Eloquent {


  function car() {
    return $this->belongsTo('Car');
  }

  function user() {
    return $this->belongsTo('User');
  }
}
