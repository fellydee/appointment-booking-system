<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function employee(){
        return $this->hasOne(Employee::class);
    }

    public function business(){
        return $this->hasOne(Business::class,'id','business_id');
    }

    public function service(){
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function getEndTime(){
        return date("H:i:s",strtotime('+' . $this->service->duration .' minutes',strtotime($this->start_time)));
    }

    public function getDateTime(){
        return strftime("%D %r",strtotime($this->start_time)+strtotime($this->date));
    }
}
