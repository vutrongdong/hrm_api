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

$factory->define(\App\Repositories\Candidates\Candidate::class, function (Faker\Generator $faker) {
	$year = rand(2014, 2018);
    $month = rand(1, 12);
    $day = rand(1, 28);

    $hour = rand(7,17);
    $minute = $faker->randomElement([00, 15, 30, 45]);

    $date = Carbon::create($year, $month, $day, $hour, $minute, 0);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->freeEmail,
        'phone' => '0'.$faker->randomNumber($nbDigits = 9),
        'source' => 'https://drive.google.com/'.$faker->slug,
        'date_apply' => $date->format('Y-m-d'),
        'time_interview' => $date->addDays(rand(1, 14))->format('Y-m-d H:i:s'),
        'plan_id' => rand(1, 5),
        'position_id' => rand(5, 7),
        'status' => rand(0, 4)
    ];
});
