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

    public function timeslot()
    {
        return $this->hasMany(Timeslot::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'employee_services');
    }

}
