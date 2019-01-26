<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'type' => 'internal_note',
        'ticket_id' => factory(App\Ticket::class),
        'user_id' => factory(App\User::class),
        'subject' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

$factory->state(App\Article::class, 'inbound_email', function ($faker) {
    return [
        'type' => 'inbound_email',
        'from' => $faker->unique()->safeEmail,
        'to' => $faker->unique()->safeEmail,
        'cc' => $faker->unique()->safeEmail
    ];
});

$factory->state(App\Article::class, 'outbound_email', function ($faker) {
    return [
        'type' => 'outbound_email',
        'from' => $faker->unique()->safeEmail,
        'to' => $faker->unique()->safeEmail,
        'cc' => $faker->unique()->safeEmail
    ];
});