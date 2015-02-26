<?php

class Car extends Eloquent {

  protected $appends = [ 'maintenance_logs' ];

  function getDisplayAttribute() {
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

  function get_status() {
    //
    switch($this->status) {
      case CarStatus::DEACTIVATED:
        $status = 'deactivated';
        break;

      case CarStatus::ACTIVE:
        $status = 'active';
        break;
    }

    return $status;
  }



  /*
    RELATIONSHIPS
  */
  function maintenanceLogs() {
    return $this->hasMany('MaintenanceLog')->orderBy('updated_at', 'desc');
  }

  function client() {
    return $this->belongsTo('Client');
  }

  function scheduledActions() {
    return $this->hasMany('ScheduledAction');
  }

}
