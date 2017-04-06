<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function timeslots()
    {
        return $this->hasMany(Timeslot::class);
    }
}
