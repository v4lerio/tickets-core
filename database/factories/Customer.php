<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'organisation_id' => factory(\App\Organisation::class),
        'name' => $faker->company
    ];
});
