<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Ambassador;
use Faker\Generator as Faker;

$factory->define(Ambassador::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
    ];
});
