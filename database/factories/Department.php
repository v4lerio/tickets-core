<?php

use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'manager_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'name' => $faker->word
    ];
});
