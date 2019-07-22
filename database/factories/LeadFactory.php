<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lead;
use App\User;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'user_created_id'   => factory(User::class),
        'user_assigned_id'  => factory(User::class),
        'name'              => $faker->name,
        'phone'             => $faker->phoneNumber,
        'email'             => $faker->email,
        'source'            => $faker->word,
        'description'      => $faker->sentence,
        'status_id'         => factory(Status::class)
    ];
});
