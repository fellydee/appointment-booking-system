<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function fullName()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function roster()
    {
        return $this->hasOne(Roster::class);
    }
}
