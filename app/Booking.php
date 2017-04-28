<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function business()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function getEndDateTime()
    {
        return strftime("%D %r", strtotime('+' . $this->service->duration . ' minutes', strtotime($this->getStartDateTime())));
    }

    public function getStartDateTime()
    {
        return strftime("%D %r", strtotime($this->date . ' ' . $this->time));
    }

    public function fullCalendarFormat()
    {
        return array(
            'id' => $this->id,
            'title' => $this->service->title . " @ " . $this->service->business->name,
            'start' => $this->getStartDateTime(),
            'end' => $this->getEndDateTime()
        );
    }
}
