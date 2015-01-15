<?php

class Car extends Eloquent {

  function details() {
    return $this->make . ' ' . $this->model . ' ' . $this->year;
  }

  function getLastMaintenanceAttribute() {

    $maintenance_log = $this->maintenance_logs()->orderBy('created_at', 'desc')->first();

    if( empty($maintenance_log) ) {
      return false;
    }

    return $maintenance_log->created_at;
  }

  function generate_qr_content() {
    //
    $content  = URL::route('cars.show', $this->id) . "\n";
    $content .= $this->client->display_name . "\n";
    $content .= $this->client->company_name . "\n";
    $content .= $this->client->phone_format();

    return $content;
  }


  /*
    RELATIONSHIPS
  */
  function maintenance_logs() {
    return $this->hasMany('MaintenanceLog');
  }

  function client() {
    return $this->belongsTo('Client');
  }

  function scheduled_actions() {
    return $this->hasMany('ScheduledAction');
  }

}
