<?php

namespace App;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $guarded = [];
    protected $hidden = ['employee_id','id'];

    /**
     * Defines the relationship between timeslot and employee
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    /**
     * Returns the day as a day string
     * @return mixed
     */
    public function getDay(){
        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        return $days[$this->day];
    }

    /**
     * Returns the start time in format 9:00 AM
     * @return false|string
     */
    public function getStartTime(){
        return date("g:i A",strtotime($this->start_time));
    }

    /**
     * Returns the end time in format 9:00 AM
     * @return false|string
     */
    public function getEndTime(){
        return date("g:i A",strtotime($this->end_time));
    }

    /**
     * Returns the timeslot as a full calendar formated array
     * @return array
     */
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

