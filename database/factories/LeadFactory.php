<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Lead;
use App\User;
use App\Models\Status;
use Faker\Generator as Faker;

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'admin_created_id'   => 1,
        'admin_assigned_id'  => 1,
        'name'              => $faker->name,
        'phone'             => $faker->PhoneNumber,
        'email'             => $faker->email,
        'source'            => $faker->word,
        'description'       => $faker->sentence,
        'company'           => 'Microsoft',
        'division'          => 'Dhaka',
        'district'          => 'Gazipur',
        'upazila'           => 'Amraid',
        'status_id'         => factory(Status::class)
    ];
});
