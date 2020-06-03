<?php

use App\Publication;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->times(3)->create()->each(function ($user) {
            $user->publications()->saveMany( 
                factory(Publication::class, rand(1, 20)
            )->make());
        });
    }
}
