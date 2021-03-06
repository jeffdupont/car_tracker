<?php namespace App\Models;

class ScheduledAction extends \Eloquent
{
    protected $appends = [ 'start_date' ];


    public function getStartDateAttribute()
    {
        //
        $options = json_decode($this->scheduled_at);
        return $options->start ?: null;
    }

    public function getRepeatAttribute()
    {
        //
        $options = json_decode($this->scheduled_at, true);
        if (isset($options['rules']['daysOfWeek']) && count($options['rules']['daysOfWeek']['units']) == 5) {
            return 'week_day';
        }
        if (isset($options['rules']['days']) && $options['rules']['days']['units'][1]) {
            return 'every_day';
        }

        return null;
    }

    public function getRepeatDaysAttribute()
    {
        //
        $options = json_decode($this->scheduled_at, true);

        if (isset($options['rules']['daysOfWeek'])) {
            $days = [];
            foreach ($options['rules']['daysOfWeek']['units'] as $unit => $value) {
                $days[] = strtolower(date('l', strtotime("Sunday +{$unit} days")));
            }
            return $days;
        }
        return [];
    }

    public function getDayAttribute()
    {
        //
        $options = json_decode($this->scheduled_at, true);

        if (isset($options['rules']['daysOfMonth'])) {
            $days = [];
            foreach ($options['rules']['daysOfMonth']['units'] as $unit => $value) {
                $days[] = $unit;
            }
            return $days;
        }

        return [];
    }


    /*
        RELATIONSHIPS
    */
    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }
}
