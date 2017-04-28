<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $guarded = [];
    protected $hidden = ['employee_id','id'];
}
