<?php

use Faker\Generator as Faker;

$factory->define(App\SupportType::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
