<?php

use Faker\Generator as Faker;

$factory->define(App\Email::class, function (Faker $faker) {
    return [
        'priority_id' => Factory(\App\Priority::class),
        'department_id' => Factory(\App\Department::class),
        'email_address' => $faker->safeEmail,
        'from_address' => $faker->safeEmail,
        'username' => $faker->safeEmail,
        'password' => 'supersecretpassword',
        'inbound_enabled' => true,
        'inbound_server' => $faker->safeEmailDomain,
        'inbound_port' => 993,
        'inbound_protocol' => 'imap',
        'inbound_encryption' => 'ssl',
        'fetch_frequency' => 1,
        'fetch_amount' => 5,
        'delete_on_fetch' => true,
        'smtp_enabled' => true,
        'smtp_server' => $faker->safeEmailDomain,
        'smtp_port' => 587,
        'smtp_auth_required' => true
    ];
});
