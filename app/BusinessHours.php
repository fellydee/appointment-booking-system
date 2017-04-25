<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    protected $hidden = ['id','business_id'];
    protected $fillable = ['business_id','day','open_time','close_time'];
}
