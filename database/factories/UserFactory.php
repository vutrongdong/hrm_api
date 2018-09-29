<?php

/*
|--------------------------------------------------------------------------
| User Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->freeEmail,
        'password' => '123456',
        'remember_token' => str_random(10),
        'qualification' => $faker->randomElement(['Đại học', 'Cao đẳng', 'Trung cấp']),
        'phone' => '0'.$faker->randomNumber($nbDigits = 9),
        'address' => $faker->address,
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '-18 years'),
        'avatar' => 'tmp/'.$faker->randomNumber($nbDigits = 9).'.jpg',
        'gender' => rand(0, 2),
        'status' => rand(0, 1)
    ];
});
