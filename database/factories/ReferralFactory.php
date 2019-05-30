<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Referral;
use Faker\Generator as Faker;

$factory->define(Referral::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
    ];
});
