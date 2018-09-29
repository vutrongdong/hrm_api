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

$factory->define(\App\Repositories\Plans\Plan::class, function (Faker\Generator $faker) {

	$year = rand(2014, 2018);
    $month = rand(1, 12);
    $day = rand(1, 28);

    $date = Carbon::create($year,$month ,$day, 0, 0, 0);

    return [
        'title' => 'Kế hoạch tuyển '.$faker->jobTitle,
        'date_start' => $date->format('Y-m-d'),
        'date_end' => $date->addMonths(rand(1, 2))->format('Y-m-d'),
        'content' => $faker->realText($maxNbChars = 200),
        'status' => rand(0, 5)
    ];
});
