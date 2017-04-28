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
}
