<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'city'=> $faker->city,
        'state' => $faker->state,
        'post_code' => $faker->postcode,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => 0
    ];
});

$factory->define(App\Employee::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address
    ];
});

$factory->define(App\Timeslot::class, function (Faker\Generator $faker) {
    return [
        'date' => \Carbon\Carbon::now(),
        'week_id' => 1,
        'start_time' => '09:00',
        'end_time' => '17:00'
    ];
});

$factory->define(App\Week::class, function (Faker\Generator $faker) {
    return [
        'start_date' => \Carbon\Carbon::now()->startOfWeek(),
        'employee_id' => 1
    ];
});
