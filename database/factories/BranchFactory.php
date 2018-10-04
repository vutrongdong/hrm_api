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

$factory->define(\App\Repositories\Branches\Branch::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'description' => $faker->realText($maxNbChars = 100),
		'about' => $faker->realText($maxNbChars = 200),
		'phone' => '0' . $faker->randomNumber($nbDigits = 9),
		'website' => $faker->unique()->url,
		'email' => $faker->unique()->companyEmail,
		'facebook' => 'facebook.com/' . $faker->unique()->company,
		'instagram' => $faker->unique()->company,
		'zalo' => $faker->unique()->company,
		'tax_number' => $faker->unique()->ean8,
		'bank' => $faker->company,
	];
});
