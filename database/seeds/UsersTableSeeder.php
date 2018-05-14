<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username = 'grace';

        DB::table('users')->insert([
            'username' => $username,
            'firstname' => 'Grace',
            'lastname' => 'Hopper',
            'email' => $username.'@gmail.com',
            'zip' => '10115',
            'birthdate' => date('2005-05-01'),
            'gender' => 'f',
            'password' => bcrypt('secret'),
        ]);

        // factory(App\User::class, 50)->create();

        // factory(App\User::class, 50)->create()->each(function ($u) {
        // $u->camps()->saveMany(factory(App\Camp::class, 4)->make());
        // });

        // factory(App\User::class, 10)->create();

        // factory(App\Camp::class, 50)->create()->each(function($u) {
        //     $u->users()->sync(
        //         App\User::all()->random(4)
        //     );
        // });
     }

}