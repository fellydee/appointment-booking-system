<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $guarded = [];

    public function roster()
    {
        return $this->belongsTo(Roster::class);
    }
}
