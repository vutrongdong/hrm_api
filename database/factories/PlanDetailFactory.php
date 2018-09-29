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

$factory->define(\App\Repositories\PlanDetails\PlanDetail::class, function (Faker\Generator $faker) {
    return [
        'plan_id' => factory(\App\Repositories\Plans\Plan::class)->create()->id,
        'department_id' => rand(1, 6),
        'position_id' => rand(5, 7),
        'quantity' => rand(1, 10)
    ];
});
