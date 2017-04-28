<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['business_id','title','description','duration','price'];
    protected $hidden = ['business_id'];
    public function employee(){
        return $this->belongsToMany(Employee::class, 'employee_services');
    }

    public function business(){
        return $this->hasOne(Business::class,'id','business_id');
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }
}
