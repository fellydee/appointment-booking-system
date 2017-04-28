<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $guarded = [];
    protected $hidden = ['employee_id','id'];

    public function getDay(){
        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        return $days[$this->day];
    }

    public function getStartTime(){
        return date("g:i A",strtotime($this->start_time));
    }

    public function getEndTime(){
        return date("g:i A",strtotime($this->end_time));
    }
}

