<?php

use Faker\Generator as Faker;

$factory->define(App\Priority::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name,
        'colour' => $this->faker->hexcolor,
        'urgency' => $this->faker->unique()->randomNumber,
    ];
});
