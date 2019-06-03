<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Referral;
use Faker\Generator as Faker;
use App\Ambassador;

$factory->define(Referral::class, function (Faker $faker) {
    return [
        'ambassador_id' => function () {
            return factory(Ambassador::class)->create()->id;
        },
        'name'      => $faker->name,
        'email'     => $faker->unique()->safeEmail,
        'phone'     => $faker->phoneNumber,
        'job'       => $faker->randomElement([
            'Property Management',
            'Accounting, Finance, HR',
            'Office Professional',
            'Light Industrial/Maintenance',
        ]),
        'location'  => $faker->randomElement([
            'Sarasota',
            'Tampa',
            'Orlando',
            'Fort Lauderdale',
        ]),
    ];
});
