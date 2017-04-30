<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['business_id','title','description','duration','price'];
    protected $hidden = ['business_id'];

    /**
     * Defines the relationship between service and the employees
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_services');
    }

    /**
     * Defines the relationship between service and the business
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function business(){
        return $this->hasOne(Business::class,'id','business_id');
    }

    /**
     * Defines the relationship between service and booking
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booking(){
        return $this->hasMany(Booking::class);
    }

    /**
     * Returns the price as a formatted price string
     * @return string
     */
    public function priceFormatted(){
        //money_format does not work on windows and is therefore not used
        return '$' . number_format($this->price, 2);
    }
}
