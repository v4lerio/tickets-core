<?php

use Faker\Generator as Faker;

$factory->define(App\Priority::class, function (Faker $faker) {
    return [
        'name' => $this->faker->word,
        'colour' => $this->faker->hexcolor,
        'urgency' => $this->faker->randomDigit,
    ];
});
