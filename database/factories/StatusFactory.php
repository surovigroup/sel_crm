<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'name'  => $faker->word,
        'color' => $faker->hexcolor
    ];
});
