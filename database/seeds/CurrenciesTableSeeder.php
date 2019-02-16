<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['id' => 1, 'currency_name' => 'USD'],
            ['id' => 2, 'currency_name' => 'EGP'],
            ['id' => 3, 'currency_name' => 'EUR'],
            ['id' => 4, 'currency_name' => 'AFN'],
            ['id' => 5, 'currency_name' => 'AUD'],
            ['id' => 6, 'currency_name' => 'BHD'],
            ['id' => 7, 'currency_name' => 'CAD'],
            ['id' => 8, 'currency_name' => 'INR'],
            ['id' => 9, 'currency_name' => 'IRR'],
            ['id' => 11, 'currency_name' => 'IQD'],
            ['id' => 12, 'currency_name' => 'SAR'],
            ['id' => 13, 'currency_name' => 'TRY'],
            ['id' => 14, 'currency_name' => 'AED'],
            ['id' => 15, 'currency_name' => 'KWD'],
        ];
        foreach($currencies as $currency){
            Currency::create($currency);
        }
    }
}
