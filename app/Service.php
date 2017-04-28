<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['business_id','title','description','duration','price'];
    protected $hidden = ['business_id'];
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_services');
    }

    public function business(){
        return $this->hasOne(Business::class,'id','business_id');
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }

    public function priceFormatted(){
        //money_format does not work on windows and is therefore not used
        return '$' . number_format($this->price, 2);
    }
}
