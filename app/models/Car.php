<?php namespace App\Models;


class Car extends \Eloquent {

  protected $appends = [ 'maintenance_logs' ];

  function getDisplayAttribute() {
    return $this->make . ' ' . $this->model . ' ' . $this->year;
  }

  function getLastMaintenanceAttribute() {

    $maintenance_log = $this->maintenance_logs()->orderBy('completed_at', 'desc')->first();

    if( empty($maintenance_log) ) {
      return false;
    }

    return $maintenance_log->completed_at;
  }

  function generate_qr_content() {
    //
    $content  = \URL::route('cars.show', $this->id) . "\n";
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

  function getScheduledLogsAttribute() {
    return $this->maintenance_logs()->where('is_completed', false)->orderBy('scheduled_at', 'asc');
  }

  function getCompletedLogsAttribute() {
    return $this->maintenance_logs()->where('is_completed', true)->orderBy('completed_at', 'desc');
  }

  function getActiveScheduledActionsAttribute() {
    return $this->scheduled_actions()->where('is_active', true)->orderBy('updated_at', 'desc');
  }



  /*
    RELATIONSHIPS
  */
  function maintenance_logs() {
    return $this->hasMany('App\Models\MaintenanceLog');
  }

  function client() {
    return $this->belongsTo('App\Models\Client');
  }

  function scheduled_actions() {
    return $this->hasMany('App\Models\ScheduledAction');
  }

}
