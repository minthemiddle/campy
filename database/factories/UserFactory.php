<?php

use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $user = $faker->firstname;
    return [
        'username' => $user.random_int(0, 2),
        'firstname' => $user,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'), // secret
        'remember_token' => str_random(10),
        'birthdate' => date('2005-05-01'),
        'zip' => '10115',
        'gender' => 'f',
        'mobile' => random_int(1,99999),
        'complete' => 0,
    ];
});