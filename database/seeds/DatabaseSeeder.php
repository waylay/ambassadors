<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class)->create([
            'name' => 'Cristian Ionel',
            'email' => 'cristian.ionel@gmail.com',
        ]);

        factory(App\User::class)->create([
            'name' => 'Robert Urban',
            'email' => 'roberturban78@gmail.com',
        ]);

        factory(App\User::class)->create([
            'name' => 'Darrin Rohr',
            'email' => 'darrin@hhstaffingservices.com',
        ]);

        factory(App\User::class)->create([
            'name' => 'Adriana Colon Gandia',
            'email' => 'adriana@hhstaffingservices.com',
        ]);

        factory(App\User::class)->create([
            'name' => 'Karen Veliz',
            'email' => 'kveliz@hhstaffingservices.com',
        ]);

        // factory(App\Ambassador::class, 1)
        //     ->create()
        //     ->each(function ($ambassador) {
        //         factory(App\Referral::class, 25)->create(['ambassador_id'=>$ambassador->id]);
        //     });
    }
}
