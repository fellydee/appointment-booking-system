<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => 0
    ];
});

$factory->define(App\Employee::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'business_id' => '1'
    ];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
    return [
        'business_id' => 1,
        'title' => $faker->word,
        'description' => $faker->sentence,
        'duration' => 30,
        'price' => $faker->numberBetween(0, 60)
    ];
});

$factory->define(App\Business::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'email' => $faker->numberBetween(0, 120),
    ];
});

$factory->define(App\Timeslot::class, function (Faker\Generator $faker) {
    return [
        'employee_id' => 1,
        'day' => $faker->numberBetween(0,6),
        'start_time' => $faker->time('H:i:s','now'),
        'end_time' => $faker->time('H:i:s','now'),
    ];
});