<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Camp::class, function (Faker $faker) {
    return [
        'shortcode' => str_random(4),
        'city' => $faker->randomElement($array = array ('Berlin', 'Köln', 'Hamburg', 'Stuttgart')),
        'max' => random_int(60, 100),
        'registration_start' => $faker->dateTimeBetween($startDate = '+6months', $endDate = '+1years', $timezone = null),
        'registration_end' => $faker->dateTimeBetween($startDate = '+6months', $endDate = '+1years', $timezone = null),
        'from' => $faker->dateTimeBetween($startDate = '+6months', $endDate = '+1years', $timezone = null),
        'to' => $faker->dateTimeBetween($startDate = '+6months', $endDate = '+1years', $timezone = null),
        'url' => '#',
    ];
});
