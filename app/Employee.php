<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    /**
     * Returns the full name of the customer
     * @return string
     */
    public function fullName()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Defines the relationship between employee and business
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Defines the relationship between employee and timeslots
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timeslots()
    {
        return $this->hasMany(Timeslot::class);
    }

    /**
     * Defines the relationship between employee and services
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class,'employee_services');
    }

    /**
     * Defines the relationship between employee and bookings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Returns if the employee is working on the given date
     * @param $date
     * @return bool
     */
    public function isWorking($date)
    {
        $dayNum = date('w', strtotime($date)) - 1;
        $daytimeslot = $this->timeslots->where('day', $dayNum)->first();
        return $daytimeslot != null;
    }

    /**
     * Returns all times the employee can work for the given date
     * @param $date
     * @return array
     */
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
        array_pop($times); // Remove the last time, this being the time they stop work as nothing can be booked then
        // Get bookings for the date given
        $bookings = $this->bookings->where('date', date("Y-m-d", strtotime($date)));

        // Remove all previous bookings from the times
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


}
