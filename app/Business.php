<?php

namespace App;

class Business extends EloquentModel
{
    protected $guarded = [];

    protected $rules = [
        'name' => 'required',
        'address' => 'required',
        'phone' => 'required|numeric',
        'email' => 'required|email|unique:businesses,email',
    ];

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
    public function services(){
        return $this->hasMany(Service::class);
    }

}
