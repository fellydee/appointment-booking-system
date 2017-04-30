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
        'duration' => $faker->numberBetween(0, 120),
        'price' => $faker->numberBetween(0, 60)
    ];
});
