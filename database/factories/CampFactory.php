<?php

use App\Camp;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Camp::class, function (Faker $faker) {
    return [
        'city' => $faker->randomElement($array = array ('Berlin', 'Köln', 'Hamburg', 'Stuttgart')),
        'max' => random_int(60, 100),
        'camp_status' => 'open',
        'contribution' => 75,
        'laptop' => 50,
        'laptop_free' => 0
    ];
});