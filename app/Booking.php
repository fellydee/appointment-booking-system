<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    /**
     * Defines the relationship between booking and employee
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    /**
     * Defines the relationship between booking and business
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function business()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }

    /**
     * Defines the relationship between booking and service
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    /**
     * Returns the end datetime for this service
     * @return string
     */
    public function getEndDateTime()
    {
        return strftime("%D %r", strtotime('+' . $this->service->duration . ' minutes', strtotime($this->getStartDateTime())));
    }

    /**
     * Returns the start datetime for this service
     * @return string
     */
    public function getStartDateTime()
    {
        return strftime("%D %r", strtotime($this->date . ' ' . $this->time));
    }

    /**
     * Returns the service in full calendar format for the customer
     * @return array
     */
    public function fullCalendarFormatCustomer()
    {
        return array(
            'id' => $this->id,
            'title' => $this->service->title . " @ " . $this->service->business->name,
            'start' => $this->getStartDateTime(),
            'end' => $this->getEndDateTime()
        );
    }

    /**
     * Returns the service in full calendar format for the owner
     * @return array
     */
    public function fullCalendarFormatOwner()
    {
        return array(
            'id' => $this->id,
            'title' => $this->service->title . " with " . $this->employee->fullName(),
            'start' => $this->getStartDateTime(),
            'end' => $this->getEndDateTime()
        );
    }
}
