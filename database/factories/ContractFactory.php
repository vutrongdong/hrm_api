<?php

use Carbon\Carbon;

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

$factory->define(\App\Repositories\Contracts\Contract::class, function (Faker\Generator $faker) {

	$year = rand(2014, 2018);
    $month = rand(1, 12);
    $day = rand(1, 28);

    $date = Carbon::create($year,$month ,$day, 0, 0, 0);

    return [
        'title' => 'Hợp đồng '.$faker->jobTitle,
        'type' => rand(0, 4),
        'date_sign' => $date->format('Y-m-d'),
        'date_effective' => $date->format('Y-m-d'),
        'date_expiration' => $date->addMonths(rand(1, 12))->format('Y-m-d'),
        'link' => 'https://drive.google.com/'.$faker->unique()->slug,
        'status' => rand(0, 2),
    ];
});
