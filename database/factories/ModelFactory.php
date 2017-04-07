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
        'city'=> $faker->city,
        'state' => $faker->state,
        'post_code' => $faker->postcode,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => 0
    ];
});

