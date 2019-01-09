<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'organisation_id' => function() {
            return factory(\App\Organisation::class)->create()->id;
        },
        'name' => $faker->company
    ];
});
