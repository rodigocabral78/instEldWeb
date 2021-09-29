<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    return [
		'color' => substr($faker->colorName, 0, 16),
		'partNumber' => $faker->randomNumber(NULL, false),
    ];
});
