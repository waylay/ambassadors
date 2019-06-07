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
            'Leasing Consultant/Property Management',
            'Accounting, Finance, HR, Marketing',
            'Office Professional/Administrative',
            'Light Industrial/Warehouse',
            'Maintenance – HVAC',
            'Maintenance/General Labor',
        ]),
        'location'  => $faker->randomElement([
            'Sarasota/Bradenton Area',
            'Tampa Area',
            'Orlando Area',
            'Fort Lauderdale Area',
        ]),
    ];
});
