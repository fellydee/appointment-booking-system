<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function employee(){
        return $this->belongsToMany(Employee::class, EmployeeService::class);
    }
}
