<?php namespace App\Models;

class MaintenanceLog extends \Eloquent {

  public function getDates()
  {
    return ['created_at', 'updated_at', 'scheduled_at', 'completed_at'];
  }

  public function status()
  {
    if( ! $this->is_completed && $this->scheduled_at->eq(\Carbon\Carbon::now()->startOfDay()) ) {
      return 'warning';
    }
    elseif( ! $this->is_completed && $this->scheduled_at->lt(\Carbon\Carbon::now()->startOfDay()) ) {
      return 'danger';
    }
  }

  public function getDescriptionAttribute()
  {
    $data = json_decode($this->additional_data);
    return isset($data) ? $data->description : null;
  }




  /*
    RELATIONSHIPS
  */

  function car() {
    return $this->belongsTo('App\Models\Car');
  }

  function user() {
    return $this->belongsTo('App\Models\User');
  }
}
