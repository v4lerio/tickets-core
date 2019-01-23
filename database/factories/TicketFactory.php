<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'customer_id' => factory(\App\Customer::class),
        'department_id' => factory(\App\Department::class),
        'support_type_id' => factory(\App\SupportType::class),
        'priority_id' => factory(\App\Priority::class),
        'subject' => $this->faker->sentence,
        'state' => collect(['open', 'closed'])->random()
    ];
});

// $table->unsignedInteger('user_id')->nullable();
// $table->unsignedInteger('customer_id')->nullable();
// $table->unsignedInteger('department_id');
// $table->unsignedInteger('support_type_id');
// $table->unsignedInteger('priority_id');
// $table->text('subject');
// $table->enum('state', ['open', 'closed'])->default('open');
