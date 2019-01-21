<?php

use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'manager_id' => factory(App\User::class),
        'name' => $faker->word
    ];
});
