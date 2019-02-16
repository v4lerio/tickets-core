<?php

use Faker\Generator as Faker;

$factory->define(App\Priority::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'colour' => $faker->hexcolor,
        'urgency' => $faker->randomDigit,
    ];
});
