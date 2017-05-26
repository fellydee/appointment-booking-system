<?php

use Illuminate\Database\Eloquent\FactoryBuilder;

class Extended extends FactoryBuilder
{
    public function __construct($class, $name, array $definitions, array $states, \Faker\Generator $faker)
    {
        parent::__construct($class, $name, $definitions, $states, $faker);
    }

    public function businessOwner()
    {
        return $this->create(['role' => 0]);
    }

    public function user()
    {
        return $this->create(['role' => 1]);
    }

    public function oneHour()
    {
        return $this->create(['duration' => 60]);
    }

    public function twoHour()
    {
        return $this->create(['duration' => 120]);
    }
}
