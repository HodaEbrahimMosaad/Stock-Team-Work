<?php

use Faker\Generator as Faker;

$factory->define(App\Pair::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'from_id' => 1,
        'to_id'   => 1,
        'duration'=> $faker->randomNumber(),
        'exchange_rate' => $faker->randomFloat()
    ];
});
