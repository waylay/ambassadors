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

        factory(App\Ambassador::class, 15)
            ->create()
            ->each(function ($ambassador) {
                factory(App\Referral::class, 25)->create(['ambassador_id'=>$ambassador->id]);
            });
    }
}
