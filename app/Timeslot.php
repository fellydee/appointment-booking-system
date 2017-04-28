<?php

namespace App;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $guarded = [];
    protected $hidden = ['employee_id','id'];

    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }

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


    public function fullCalendarFormat()
    {
        return array(
            'id' => $this->id,
            'title' => $this->employee->fullName(),
            'start' => strftime("%D %r", strtotime(strftime($this->getDay() . "this week") . " " . $this->start_time)),
            'end' => strftime("%D %r", strtotime(strftime($this->getDay() . "this week") . " " . $this->end_time))
        );
    }
}

