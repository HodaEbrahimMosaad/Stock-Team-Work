<?php

use Faker\Generator as Faker;

$factory->define(App\Currency::class, function (Faker $faker) {
    return [
        'currency_name' => $faker->unique()->randomElement([
        	'USD', 'EGP', 'EUR', 'AFN', 'AUD', 'BHD', 'CAD',
        	'INR', 'IRR', 'IQD', 'SAR', 'TRY', 'AED', 'KWD'
        ])
    ];
});
