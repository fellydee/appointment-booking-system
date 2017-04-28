<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function fullName()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function timeslots()
    {
        return $this->hasMany(Timeslot::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'employee_services');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isWorking($date)
    {
        $dayNum = date('w', strtotime($date)) - 1;
        $daytimeslot = $this->timeslots->where('day', $dayNum)->first();
        return $daytimeslot != null;
    }

    public function timesAvailable($date)
    {
        $dayNum = date('w', strtotime($date)) - 1;
        $daytimeslot = $this->timeslots->where('day', $dayNum)->first();

        // Make list of 30 min blocks within business hours
        $times = array();
        $current = $daytimeslot->start_time;
        for (; ;) {
            array_push($times, $current);
            if ($current == $daytimeslot->end_time) {
                break;
            }
            $current = date("H:i:s", strtotime("+30 minutes", strtotime($current)));
        }
        // Get bookings for the date given
        $bookings = $this->bookings->where('date', date("Y-m-d", strtotime($date)));
        foreach ($bookings as $booking) {
            $slotsToRemove = $booking->service->duration / 30;
            $index = array_search($booking->time, $times);
            for ($i = 0; $i < $slotsToRemove; $i++) {
                unset($times[$index + $i]);
            }
        }
        return array_values($times);

        // Return array of times
    }

    public function isBookableAt($date, $time, $length)
    {
        if (!$this->isWorking($date)) {
            return false;
        }
        $bookings = $this->bookings->where('date', date("Y-m-d", strtotime($date)));
        foreach ($bookings as $booking) {
            if (strtotime($booking->time) != strtotime($time)) {
            }
        }
    }

}
