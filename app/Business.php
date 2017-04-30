<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = [];

    /**
     * Defines the relationship between business and employee
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class,'business_id','id');
    }

    /**
     * Defines the relationship between business and businessHours
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businessHours(){
        return $this->hasMany(BusinessHours::class);
    }

    /**
     * Defines the relationship between business and service
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service(){
        return $this->hasMany(Service::class);
    }

}
