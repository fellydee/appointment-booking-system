<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['business_id','title','description','length'];

    public function employee(){
        return $this->belongsToMany(Employee::class, EmployeeService::class);
    }
}
