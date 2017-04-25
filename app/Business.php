<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function businessHours(){
        return $this->hasMany(BusinessHours::class);
    }

    public function service(){
        return $this->hasMany(Service::class);
    }

}
