<?php

use Faker\Generator as Faker;

$factory->define(App\Pair::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'from_id' => factory('App\Currency'),
        'to_id'   => factory('App\Currency'),
        'duration'=> $faker->randomNumber(),
        'exchange_ratio' => $faker->randomFloat()
    ];
});
