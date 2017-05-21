<?php

namespace App;

class BusinessHours extends EloquentModel
{
    protected $guarded = [];

    protected $hidden = ['id', 'business_id'];
}
