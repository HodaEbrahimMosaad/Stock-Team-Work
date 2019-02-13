<?php

use Faker\Generator as Faker;

$factory->define(App\Trigger::class, function (Faker $faker) {
	$user = factory('App\User')->create();
	$pair = factory('App\Pair')->create(['user_id'=>$user->id]);
    return [
        'user_id' => $user->id,
        'pair_id' => $pair->id,
        'event_type_id' => $faker->randomElement(['more', 'less']),
        'level' => $faker->randomNumber()
    ];
});
