<?php

use App\Comment;
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
            $publications = $user->publications()->saveMany( 
                factory(Publication::class, rand(1, 8))->make()
            );

            $publications->each(function ($publication) {
                $publication->comments()->saveMany(
                    factory(Comment::class, rand(0, 18))->make()
                );
            });
        });
    }
}
