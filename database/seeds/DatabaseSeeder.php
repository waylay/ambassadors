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
        ])->each(function ($user) {
            $user->referrals()->saveMany(factory(App\Referral::class,10)->make());
        });

        factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->referrals()->saveMany(factory(App\Referral::class,10)->make());
            });
    }
}
